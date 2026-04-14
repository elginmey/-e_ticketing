<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Booking;
use App\Models\Schedule;
use Illuminate\Support\Facades\DB;


class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function register()
    {
        return view('auth.register');
    }
    public function postRegister(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user'
        ]);
        return redirect('/');
    }

    public function postLogin(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect('/dashboard');
        }
        return back();
    }

    public function dashboard()
    {
        if (Auth::user()->role == 'admin') {
            $schedules = Schedule::latest()->get();
            $pendingBookings = Booking::with(['user', 'schedule'])
                ->where('status', 'pending')
                ->latest()
                ->get();
            $confirmedBookings = Booking::with(['user', 'schedule'])
                ->where('status', 'lunas')
                ->latest()
                ->get();

            return view('admin.dashboard', compact('schedules', 'pendingBookings', 'confirmedBookings'));
        }

        $schedules = Schedule::where('stock', '>', 0)->get();
        return view('user.dashboard', compact('schedules'));
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
