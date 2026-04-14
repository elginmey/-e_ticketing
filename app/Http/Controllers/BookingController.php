<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Schedule;


class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function show($id)
    {
        $schedule = Schedule::findOrFail($id);
        return view('user.booking_detail', compact('schedule'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request, $id)
    { {
            $schedule = Schedule::findOrFail($id);

            $total_price = $request->total_seats * $schedule->price;

            $booking = Booking::create([
                'user_id' => Auth::id(),
                'schedule_id' => $schedule->id,
                'total_seats' => $request->total_seats,
                'total_price' => $total_price,
                'status' => 'pending'
            ]);

            $schedule->decrement('stock', $request->total_seats);

            // ⬇️ arahkan ke konfirmasi
            return redirect('/konfirmasi/' . $booking->id);
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function history()
    {
        $orders = Booking::where('user_id', Auth::id())
            ->with('schedule')
            ->latest()
            ->get();
        return view('user.history', compact('orders'));
    }

    public function konfirmasi($id)
    {
        $booking = Booking::with('schedule')->findOrFail($id);

        return view('user.konfirmasi', compact('booking'));
    }

    public function bayar(Request $request, $id)
    {
        $request->validate([
            'metode_pembayaran' => 'required',
            'bukti_pembayaran' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);
        $booking = Booking::findOrFail($id);

        // upload bukti pembayaran
        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran')->store('bukti', 'public');
        } else {
            $file = null;
        }

        $booking->update([
            'metode_pembayaran' => $request->metode_pembayaran,
            'status' => 'pending',
            'bukti_pembayaran' => $file
        ]);

        return redirect('/invoice/' . $booking->id);
    }
    public function invoice($id)
    {
        $booking = Booking::with('schedule')->findOrFail($id);

        return view('user.invoice', compact('booking'));
    }

    /**
     * Display the specified resource.
     */
    public function index(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
