<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\BroadcastMessage;
use App\Services\BroadcastService;
use Carbon\Carbon;

class SendScheduledBroadcasts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'broadcast:send-scheduled';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send scheduled broadcast messages';

    protected $broadcastService;

    public function __construct(BroadcastService $broadcastService)
    {
        parent::__construct();
        $this->broadcastService = $broadcastService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking for scheduled broadcasts...');

        $scheduledBroadcasts = BroadcastMessage::where('status', 'scheduled')
            ->where('scheduled_at', '<=', Carbon::now())
            ->get();

        if ($scheduledBroadcasts->isEmpty()) {
            $this->info('No scheduled broadcasts found.');
            return;
        }

        $this->info("Found {$scheduledBroadcasts->count()} scheduled broadcast(s).");

        foreach ($scheduledBroadcasts as $broadcast) {
            $this->info("Sending broadcast: {$broadcast->title}");
            
            $result = $this->broadcastService->sendBroadcast($broadcast);
            
            if ($result['success']) {
                $this->info("✓ Broadcast sent successfully: {$result['message']}");
            } else {
                $this->error("✗ Failed to send broadcast: {$result['message']}");
            }
        }

        $this->info('Scheduled broadcast processing completed.');
    }
}
