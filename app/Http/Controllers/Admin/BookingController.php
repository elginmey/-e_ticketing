<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'schedule'])->latest()->get();
        return view('admin.bookings.index', compact('bookings'));
    }

    public function confirm($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update([
            'status' => 'lunas',
            'kode_booking' => $booking->kode_booking ?: 'FLY' . rand(1000, 9999),
        ]);

        return redirect()->back()->with('success', 'Pesanan berhasil dikonfirmasi.');
    }
    public function uploadBukti(Request $request, $id)
    {
        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $booking = Booking::findOrFail($id);

        // Simpan file ke folder storage/app/public/bukti
        $path = $request->file('bukti_pembayaran')->store('bukti', 'public');

        // Update path gambar di database
        $booking->update([
            'bukti_pembayaran' => $path,
            'status' => 'pending' // Ubah status jadi pending konfirmasi admin
        ]);

        return redirect()->back()->with('success', 'Bukti pembayaran berhasil diunggah!');
    }
}
