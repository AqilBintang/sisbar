<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BroadcastMessage;
use App\Services\BroadcastService;
use App\Services\WhatsAppService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class BroadcastController extends Controller
{
    protected $broadcastService;
    protected $whatsappService;

    public function __construct(BroadcastService $broadcastService)
    {
        $this->broadcastService = $broadcastService;
    }

    /**
     * Display broadcast list
     */
    public function index()
    {
        $broadcasts = BroadcastMessage::with('creator')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.broadcast.index', compact('broadcasts'));
    }

    /**
     * Show create broadcast form
     */
    public function create()
    {
        // Get templates from appropriate service
        if (config('services.fonnte.token') && config('services.fonnte.token') !== 'your_fonnte_token_here') {
            $fontteService = new \App\Services\FontteWhatsAppService();
            $templates = $fontteService->getMessageTemplates();
        } else {
            $whatsappService = new \App\Services\WhatsAppService();
            $templates = $whatsappService->getMessageTemplates();
        }
        return view('admin.broadcast.create', compact('templates'));
    }

    /**
     * Store new broadcast
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'type' => 'required|in:promo,notification,reminder,general',
            'target_criteria.user_type' => 'required|in:all,with_bookings,recent_bookings,upcoming_bookings,pending_payment',
            'scheduled_at' => 'nullable|date|after:now',
            'send_now' => 'boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $broadcast = $this->broadcastService->createBroadcast([
                'title' => $request->title,
                'message' => $request->message,
                'type' => $request->type,
                'target_criteria' => $request->target_criteria,
                'scheduled_at' => $request->scheduled_at ? Carbon::parse($request->scheduled_at) : null,
                'status' => $request->send_now ? 'draft' : 'draft'
            ]);

            if ($request->send_now) {
                $result = $this->broadcastService->sendBroadcast($broadcast);
                
                if ($result['success']) {
                    return redirect()->route('admin.broadcast.show', $broadcast)
                        ->with('success', $result['message']);
                } else {
                    return redirect()->back()
                        ->with('error', $result['message']);
                }
            } elseif ($request->scheduled_at) {
                $this->broadcastService->scheduleBroadcast($broadcast, Carbon::parse($request->scheduled_at));
                return redirect()->route('admin.broadcast.show', $broadcast)
                    ->with('success', 'Broadcast berhasil dijadwalkan');
            }

            return redirect()->route('admin.broadcast.show', $broadcast)
                ->with('success', 'Broadcast berhasil dibuat');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal membuat broadcast: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Show broadcast details
     */
    public function show(BroadcastMessage $broadcast)
    {
        $broadcast->load(['creator', 'recipients.user']);
        $stats = $this->broadcastService->getBroadcastStats($broadcast);
        
        return view('admin.broadcast.show', compact('broadcast', 'stats'));
    }

    /**
     * Send broadcast manually
     */
    public function send(BroadcastMessage $broadcast)
    {
        if ($broadcast->status !== 'draft' && $broadcast->status !== 'scheduled') {
            return redirect()->back()
                ->with('error', 'Broadcast sudah dikirim atau status tidak valid');
        }

        $result = $this->broadcastService->sendBroadcast($broadcast);
        
        if ($result['success']) {
            return redirect()->back()
                ->with('success', $result['message']);
        } else {
            return redirect()->back()
                ->with('error', $result['message']);
        }
    }

    /**
     * Preview target users
     */
    public function previewTargets(Request $request)
    {
        try {
            $criteria = $request->target_criteria ?? [];
            $users = $this->broadcastService->getTargetUsers($criteria);
            
            return response()->json([
                'count' => $users->count(),
                'users' => $users->take(10)->map(function($user) {
                    $lastBooking = null;
                    try {
                        $lastBooking = $user->bookings()->latest()->first()?->booking_date?->format('d/m/Y');
                    } catch (\Exception $e) {
                        // Handle case where bookings relationship doesn't exist
                        $lastBooking = 'N/A';
                    }
                    
                    return [
                        'name' => $user->name,
                        'whatsapp_number' => $user->whatsapp_number,
                        'whatsapp_verified' => $user->whatsapp_verified ? 'Verified' : 'Not Verified',
                        'last_booking' => $lastBooking
                    ];
                })
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to load target users: ' . $e->getMessage(),
                'count' => 0,
                'users' => []
            ], 500);
        }
    }

    /**
     * Get message template
     */
    public function getTemplate(Request $request)
    {
        $templates = $this->whatsappService->getMessageTemplates();
        $templateKey = $request->template;
        
        if (isset($templates[$templateKey])) {
            return response()->json($templates[$templateKey]);
        }
        
        return response()->json(['error' => 'Template not found'], 404);
    }

    /**
     * Delete broadcast
     */
    public function destroy(BroadcastMessage $broadcast)
    {
        if ($broadcast->status === 'sent') {
            return redirect()->back()
                ->with('error', 'Tidak dapat menghapus broadcast yang sudah dikirim');
        }

        $broadcast->delete();
        
        return redirect()->route('admin.broadcast.index')
            ->with('success', 'Broadcast berhasil dihapus');
    }

    /**
     * Show WhatsApp configuration status
     */
    public function config()
    {
        $config = [
            'fontte' => [
                'configured' => config('services.fonnte.token') && config('services.fonnte.token') !== 'your_fonnte_token_here',
                'token' => config('services.fonnte.token') ? '***' . substr(config('services.fonnte.token'), -4) : 'Not set',
                'status' => 'Primary Service'
            ],
            'twilio' => [
                'configured' => config('services.twilio.sid') && config('services.twilio.sid') !== 'your_twilio_account_sid_here',
                'sid' => config('services.twilio.sid') ? '***' . substr(config('services.twilio.sid'), -4) : 'Not set',
                'from' => config('services.twilio.whatsapp_from'),
                'status' => 'Fallback Service'
            ],
            'current_service' => $this->getCurrentService()
        ];

        return view('admin.broadcast.config', compact('config'));
    }

    /**
     * Get current WhatsApp service being used
     */
    private function getCurrentService()
    {
        if (config('services.fonnte.token') && config('services.fonnte.token') !== 'your_fonnte_token_here') {
            return 'Fonnte';
        } elseif (config('services.twilio.sid') && config('services.twilio.sid') !== 'your_twilio_account_sid_here') {
            return 'Twilio';
        } else {
            return 'Mock (Testing)';
        }
    }
}
