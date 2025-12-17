<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\BroadcastMessage;
use App\Services\BroadcastService;
use Illuminate\Support\Facades\Log;

class SendBroadcastJob implements ShouldQueue
{
    use Queueable;

    protected $broadcastId;

    /**
     * Create a new job instance.
     */
    public function __construct($broadcastId)
    {
        $this->broadcastId = $broadcastId;
    }

    /**
     * Execute the job.
     */
    public function handle(BroadcastService $broadcastService): void
    {
        try {
            $broadcast = BroadcastMessage::find($this->broadcastId);
            
            if (!$broadcast) {
                Log::error("Broadcast not found: {$this->broadcastId}");
                return;
            }

            Log::info("Processing broadcast job: {$broadcast->title}");
            
            $result = $broadcastService->sendBroadcast($broadcast);
            
            if ($result['success']) {
                Log::info("Broadcast job completed successfully: {$broadcast->title}");
            } else {
                Log::error("Broadcast job failed: {$broadcast->title} - {$result['message']}");
            }
            
        } catch (\Exception $e) {
            Log::error("Broadcast job exception: {$e->getMessage()}");
            throw $e;
        }
    }

    /**
     * Handle a job failure.
     */
    public function failed(\Throwable $exception): void
    {
        Log::error("Broadcast job failed with exception: {$exception->getMessage()}");
        
        // Update broadcast status to failed
        $broadcast = BroadcastMessage::find($this->broadcastId);
        if ($broadcast) {
            $broadcast->update(['status' => 'failed']);
        }
    }
}
