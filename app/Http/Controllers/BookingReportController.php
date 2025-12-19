<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf; // Pastikan ini sudah terinstall

class BookingReportController extends Controller
{
    public function print(Request $request)
    {
        $start = $request->query('start');
        $end = $request->query('end');

        // Pastikan variabel nama di sini ($startDate, $endDate) 
        // sama dengan yang dipanggil di file booking-pdf.blade.php Anda
        $startDate = Carbon::parse($start)->format('d F Y');
        $endDate = Carbon::parse($end)->format('d F Y');

        $bookings = Booking::whereBetween('start_time', [
                Carbon::parse($start)->startOfDay(), 
                Carbon::parse($end)->endOfDay()
            ])
            ->where('status', 'confirmed')
            ->with(['user', 'field'])
            ->get();

        $totalPendapatan = $bookings->sum('total_price');

        // Load view sesuai folder Anda: admin/reports/booking-pdf
        $pdf = Pdf::loadView('admin.reports.booking-pdf', [
            'bookings' => $bookings,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'total' => $totalPendapatan
        ]);

        // Download otomatis atau tampilkan di browser (stream)
        return $pdf->stream('Laporan-Pendapatan-' . $start . '-ke-' . $end . '.pdf');
    }
}