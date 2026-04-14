<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Schedule;


class ScheduleController extends Controller
{
    public function create()
    {
        return view('admin.schedules.create');
    }
    public function store(Request $request)
    {
        Schedule::create($request->all());
        return redirect('/dashboard');
    }
    public function edit($id)
    {
        $schedule = Schedule::findOrFail($id);
        return view('admin.schedules.edit', compact('schedule'));
    }
    public function update(Request $request, $id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->update($request->all());
        return redirect('/dashboard');
    }
    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();
        return redirect('/dashboard');
    }
}
