<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class GenerateBulkPDF extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pdf:generate-bulk {--date=} {--status=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate bulk PDF receipts for bookings';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('=== Bulk PDF Generation ===');
        
        $query = Booking::with(['barber', 'service']);
        
        // Filter by date if provided
        if ($this->option('date')) {
            $date = $this->option('date');
            $query->whereDate('booking_date', $date);
            $this->info('Filtering by date: ' . $date);
        }
        
        // Filter by status if provided
        if ($this->option('status')) {
            $status = $this->option('status');
            $query->where('payment_status', $status);
            $this->info('Filtering by payment status: ' . $status);
        }
        
        $bookings = $query->get();
        
        if ($bookings->isEmpty()) {
            $this->warn('No bookings found with the specified criteria.');
            return 0;
        }
        
        $this->info('Found ' . $bookings->count() . ' booking(s)');
        
        // Create directory for bulk PDFs
        $directory = 'bulk-receipts/' . date('Y-m-d-H-i-s');
        Storage::makeDirectory($directory);
        
        $successCount = 0;
        $errorCount = 0;
        
        foreach ($bookings as $booking) {
            try {
                $this->info("Generating PDF for Booking ID: {$booking->id}");
                
                // Generate PDF
                $pdf = Pdf::loadView('pdf.receipt', compact('booking'));
                $pdf->setPaper('A4', 'portrait');
                
                // Save PDF to storage
                $filename = "Receipt-{$booking->id}-{$booking->customer_name}.pdf";
                $filepath = $directory . '/' . $filename;
                
                Storage::put($filepath, $pdf->output());
                
                $successCount++;
                
            } catch (\Exception $e) {
                $this->error("Failed to generate PDF for Booking ID {$booking->id}: " . $e->getMessage());
                $errorCount++;
            }
        }
        
        $this->info('');
        $this->info('=== Generation Complete ===');
        $this->info("✅ Success: {$successCount} PDFs generated");
        
        if ($errorCount > 0) {
            $this->warn("❌ Errors: {$errorCount} PDFs failed");
        }
        
        $this->info("📁 Files saved to: storage/app/{$directory}");
        
        return 0;
    }
}
