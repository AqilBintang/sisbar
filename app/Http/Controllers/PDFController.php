<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function downloadReceipt($id)
    {
        try {
            $booking = Booking::with(['barber', 'service'])->findOrFail($id);
            
            // Generate PDF
            $pdf = Pdf::loadView('pdf.receipt', compact('booking'));
            
            // Set paper size and orientation
            $pdf->setPaper('A4', 'portrait');
            
            // Generate filename
            $filename = 'Receipt-Booking-' . $booking->id . '-' . date('Y-m-d') . '.pdf';
            
            // Return PDF download
            return $pdf->download($filename);
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal generate PDF: ' . $e->getMessage());
        }
    }
    
    public function viewReceipt($id)
    {
        try {
            $booking = Booking::with(['barber', 'service'])->findOrFail($id);
            
            // Generate PDF for viewing in browser
            $pdf = Pdf::loadView('pdf.receipt', compact('booking'));
            $pdf->setPaper('A4', 'portrait');
            
            // Return PDF for viewing
            return $pdf->stream('Receipt-Booking-' . $booking->id . '.pdf');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal generate PDF: ' . $e->getMessage());
        }
    }
}
