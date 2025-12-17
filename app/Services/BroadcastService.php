<?php

namespace App\Services;

use App\Models\BroadcastMessage;
use App\Models\BroadcastRecipient;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class BroadcastService
{
    protected $whatsappService;

    public function __construct()
    {
        // Use Fonnte as primary WhatsApp service
        if (config('services.fonnte.token') && config('services.fonnte.token') !== 'your_fonnte_token_here') {
            $this->whatsappService = new FontteWhatsAppService();
        } 
        // Fallback to Twilio if Fonnte not configured
        elseif (config('services.twilio.sid') && 
                config('services.twilio.sid') !== 'your_twilio_account_sid_here' && 
                config('services.twilio.token') !== 'your_twilio_auth_token_here') {
            $this->whatsappService = new WhatsAppService();
        } 
        // Use Mock service if neither is configured
        else {
            $this->whatsappService = new MockWhatsAppService();
        }
    }

    /**
     * Create broadcast message
     */
    public function createBroadcast(array $data): BroadcastMessage
    {
        return BroadcastMessage::create([
            'title' => $data['title'],
            'message' => $data['message'],
            'type' => $data['type'],
            'target_criteria' => $data['target_criteria'] ?? [],
            'status' => $data['status'] ?? 'draft',
            'scheduled_at' => $data['scheduled_at'] ?? null,
            'created_by' => auth()->id() ?? $this->getOrCreateAdminUser()
        ]);
    }

    /**
     * Get target users based on criteria
     */
    public function getTargetUsers(array $criteria): \Illuminate\Database\Eloquent\Collection
    {
        $query = User::where('allow_broadcast', true)
                    ->whereNotNull('whatsapp_number');
        
        // Include unverified users for testing (can be changed in production)
        if (!isset($criteria['require_verified']) || !$criteria['require_verified']) {
            // Include both verified and unverified users
        } else {
            $query->where('whatsapp_verified', true);
        }

        // Filter berdasarkan kriteria
        if (!empty($criteria['user_type'])) {
            switch ($criteria['user_type']) {
                case 'all':
                    // Semua user yang allow broadcast
                    break;
                case 'with_bookings':
                    $query->whereHas('bookings');
                    break;
                case 'recent_bookings':
                    $query->whereHas('bookings', function($q) {
                        $q->where('created_at', '>=', Carbon::now()->subDays(30));
                    });
                    break;
                case 'upcoming_bookings':
                    $query->whereHas('bookings', function($q) {
                        $q->where('booking_date', '>=', Carbon::now())
                          ->where('status', 'confirmed');
                    });
                    break;
                case 'pending_payment':
                    $query->whereHas('bookings', function($q) {
                        $q->where('payment_status', 'pending');
                    });
                    break;
            }
        }

        // Filter berdasarkan tanggal registrasi
        if (!empty($criteria['registration_date_from'])) {
            $query->where('created_at', '>=', $criteria['registration_date_from']);
        }

        if (!empty($criteria['registration_date_to'])) {
            $query->where('created_at', '<=', $criteria['registration_date_to']);
        }

        return $query->get();
    }

    /**
     * Prepare recipients for broadcast
     */
    public function prepareRecipients(BroadcastMessage $broadcast): int
    {
        $users = $this->getTargetUsers($broadcast->target_criteria ?? []);
        
        $recipients = [];
        foreach ($users as $user) {
            $recipients[] = [
                'broadcast_message_id' => $broadcast->id,
                'user_id' => $user->id,
                'whatsapp_number' => $user->whatsapp_number,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        if (!empty($recipients)) {
            BroadcastRecipient::insert($recipients);
            $broadcast->update(['total_recipients' => count($recipients)]);
        }

        return count($recipients);
    }

    /**
     * Send broadcast message
     */
    public function sendBroadcast(BroadcastMessage $broadcast): array
    {
        if ($broadcast->status !== 'draft' && $broadcast->status !== 'scheduled') {
            return ['success' => false, 'message' => 'Broadcast sudah dikirim atau status tidak valid'];
        }

        // Jika belum ada recipients, prepare dulu
        if ($broadcast->recipients()->count() === 0) {
            $this->prepareRecipients($broadcast);
        }

        $pendingRecipients = $broadcast->pendingRecipients;
        $successCount = 0;
        $failedCount = 0;

        DB::beginTransaction();
        try {
            foreach ($pendingRecipients as $recipient) {
                // Replace variables in message
                $message = $this->replaceMessageVariables($broadcast->message, $recipient->user);
                
                // Send WhatsApp message
                $result = $this->whatsappService->sendMessage($recipient->whatsapp_number, $message);
                
                if ($result['success']) {
                    // Check if using Twilio and if this might be a sandbox limitation
                    if (get_class($this->whatsappService) === 'App\Services\WhatsAppService') {
                        // Twilio sandbox - only company number actually receives messages
                        if ($recipient->whatsapp_number === '+6285729421875' || $recipient->whatsapp_number === '6285729421875') {
                            $recipient->update([
                                'status' => 'sent',
                                'sent_at' => now()
                            ]);
                            $successCount++;
                        } else {
                            $recipient->update([
                                'status' => 'sandbox_limited',
                                'error_message' => 'Twilio Sandbox: Nomor belum join sandbox, pesan tidak terkirim meskipun API success'
                            ]);
                            $failedCount++;
                        }
                    } else {
                        // Fontte or other service - trust the API response
                        $recipient->update([
                            'status' => 'sent',
                            'sent_at' => now()
                        ]);
                        $successCount++;
                    }
                } else {
                    $recipient->update([
                        'status' => 'failed',
                        'error_message' => $result['error']
                    ]);
                    $failedCount++;
                }

                // Add small delay to avoid rate limiting
                usleep(500000); // 0.5 second delay
            }

            // Update broadcast status
            $broadcast->update([
                'status' => 'sent',
                'sent_at' => now(),
                'successful_sends' => $successCount,
                'failed_sends' => $failedCount
            ]);

            DB::commit();

            Log::info("Broadcast sent", [
                'broadcast_id' => $broadcast->id,
                'success_count' => $successCount,
                'failed_count' => $failedCount
            ]);

            return [
                'success' => true,
                'message' => "Broadcast berhasil dikirim ke $successCount penerima",
                'success_count' => $successCount,
                'failed_count' => $failedCount
            ];

        } catch (\Exception $e) {
            DB::rollback();
            Log::error("Failed to send broadcast", [
                'broadcast_id' => $broadcast->id,
                'error' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'message' => 'Gagal mengirim broadcast: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Replace variables in message with user data
     */
    private function replaceMessageVariables(string $message, User $user): string
    {
        $variables = [
            '{name}' => $user->name,
            '{email}' => $user->email,
        ];

        // Get latest booking if exists
        $latestBooking = $user->bookings()->latest()->first();
        if ($latestBooking) {
            $variables['{date}'] = $latestBooking->booking_date->format('d/m/Y');
            $variables['{time}'] = $latestBooking->booking_time;
            $variables['{barber}'] = $latestBooking->barber->name ?? 'N/A';
            $variables['{total}'] = number_format($latestBooking->total_price, 0, ',', '.');
        }

        return str_replace(array_keys($variables), array_values($variables), $message);
    }

    /**
     * Get or create admin user for broadcast creation
     */
    private function getOrCreateAdminUser(): int
    {
        $adminUser = User::where('email', 'admin@sisbar.com')->first();
        
        if (!$adminUser) {
            $adminUser = User::create([
                'name' => 'Admin Sisbar',
                'email' => 'admin@sisbar.com',
                'password' => bcrypt('admin123'),
                'role' => 'admin',
                'whatsapp_number' => '+6285729421875',
                'whatsapp_verified' => true,
                'allow_broadcast' => false // Admin tidak perlu menerima broadcast
            ]);
        }
        
        return $adminUser->id;
    }

    /**
     * Schedule broadcast
     */
    public function scheduleBroadcast(BroadcastMessage $broadcast, Carbon $scheduledAt): bool
    {
        $broadcast->update([
            'status' => 'scheduled',
            'scheduled_at' => $scheduledAt
        ]);

        // Prepare recipients
        $this->prepareRecipients($broadcast);

        return true;
    }

    /**
     * Get broadcast statistics
     */
    public function getBroadcastStats(BroadcastMessage $broadcast): array
    {
        return [
            'total_recipients' => $broadcast->total_recipients,
            'successful_sends' => $broadcast->successful_sends,
            'failed_sends' => $broadcast->failed_sends,
            'pending_sends' => $broadcast->pendingRecipients()->count(),
            'delivery_rate' => $broadcast->total_recipients > 0 
                ? round(($broadcast->successful_sends / $broadcast->total_recipients) * 100, 2) 
                : 0
        ];
    }
}