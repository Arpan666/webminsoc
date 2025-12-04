<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Field;
use App\Models\PriceSetting; // Pastikan model PriceSetting diimport
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Untuk debugging jika perlu

class BookingController extends Controller
{
    public function process(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors('Anda harus login untuk melakukan booking.');
        }

        $request->validate([
            'field_id' => 'required|exists:fields,id',
            'date' => 'required|date|after_or_equal:today',
            'start_time' => 'required',
            'duration' => 'required|integer|min:1|max:8',
        ]);

        $field = Field::findOrFail($request->field_id);

        // 1. Format Waktu Mulai (Gabungkan Tanggal + Jam + Detik 00)
        $startDateTimeString = $request->date . ' ' . $request->start_time . ':00';
        $startDateTime = Carbon::parse($startDateTimeString); 
        
        $durationInt = (int) $request->duration;
        $endDateTime = $startDateTime->copy()->addHours($durationInt);

        // 2. Cek Overlapping (Apakah jadwal bentrok?)
        $overlapping = Booking::where('field_id', $field->id)
            ->where(function ($query) use ($startDateTime, $endDateTime) {
                // Logika: Jadwal baru 'overlap' jika MULAI sebelum SELESAI jadwal lain, 
                // DAN SELESAI setelah MULAI jadwal lain.
                $query->where('start_time', '<', $endDateTime)
                      ->where('end_time', '>', $startDateTime);
            })
            // Kita abaikan booking yang statusnya 'cancelled' atau 'rejected' (opsional, tergantung sistem Anda)
            ->whereNotIn('status', ['cancelled', 'rejected']) 
            ->exists();

        if ($overlapping) {
            return back()->withErrors(['start_time' => 'Slot waktu ini sudah dibooking. Silakan pilih waktu lain.']);
        }

        // 3. --- HITUNG HARGA DINAMIS BERDASARKAN TABEL PRICE_SETTINGS ---
        try {
            $totalPrice = $this->calculateTotalPrice($field->id, $startDateTime, $durationInt);
        } catch (\Exception $e) {
            // Tangkap error jika harga tidak ditemukan di database
            return back()->withErrors(['field_id' => $e->getMessage()]);
        }
        // ----------------------------------------------------------------

        // 4. Simpan Booking (Status awal: unpaid)
        $booking = Booking::create([
            'field_id' => $field->id,
            'user_id' => Auth::id(), 
            'start_time' => $startDateTime,
            'end_time' => $endDateTime,
            'status' => 'unpaid', 
            'total_price' => $totalPrice,
        ]);

        // 5. Redirect ke halaman pembayaran
        return redirect()->route('payment.show', ['booking' => $booking->id])
                         ->with('info', 'Booking berhasil dibuat. Mohon selesaikan pembayaran.');
    }

    /**
     * Menghitung total harga dengan melihat tabel price_settings per jam.
     */
    private function calculateTotalPrice($fieldId, Carbon $startDateTime, int $duration)
    {
        $total = 0;
        $currentTime = $startDateTime->copy();

        // Loop sebanyak durasi jam (misal 2 jam = 2 kali loop)
        for ($i = 0; $i < $duration; $i++) {
            
            // A. Tentukan Jenis Hari (weekday / weekend)
            // isWeekend() mengembalikan true untuk Sabtu & Minggu
            $isWeekend = $currentTime->isWeekend(); 
            $dayType = $isWeekend ? 'weekend' : 'weekday'; 

            // B. Ambil format jam saja (H:i:s), misal "14:00:00"
            $timeString = $currentTime->format('H:i:s');

            // C. Query ke tabel price_settings
            // Mencari harga di mana jam main kita berada DI ANTARA start_time dan end_time
            $priceSetting = PriceSetting::where('field_id', $fieldId)
                ->where('day_type', $dayType) // Sesuaikan dengan nama kolom DB Anda
                ->where('start_time', '<=', $timeString)
                ->where('end_time', '>', $timeString)
                ->first();

            // Jika admin lupa setting harga untuk jam tersebut
            if (!$priceSetting) {
                $formattedTime = $currentTime->format('d M Y H:i');
                throw new \Exception("Harga belum diatur oleh admin untuk Lapangan ini pada {$dayType} jam {$formattedTime}. Hubungi admin.");
            }

            // D. Tambahkan harga per jam ke total
            // Menggunakan kolom 'price_per_hour' sesuai screenshot Anda
            $total += $priceSetting->price_per_hour; 

            // E. Lanjut ke jam berikutnya
            $currentTime->addHour();
        }

        return $total;
    }

    public function success()
    {
        return view('booking.success');
    }
}