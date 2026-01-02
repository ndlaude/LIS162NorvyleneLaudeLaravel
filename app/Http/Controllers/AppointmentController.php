<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['patient', 'schedule.doctor'])
            ->orderBy('date', 'desc')
            ->get();
        $title = 'All Appointments';

        return view('appointments.index', compact('appointments', 'title'));
    }

    public function create()
    {
        $schedules = \App\Models\Schedule::with('doctor')->get();
        return view('appointments.create', compact('schedules'));
    }

    public function store(Request $request)
    {
        // Validation now matches the migration exactly
        $request->validate([
            'schedule_id' => 'required|integer',
        ]);

        $schedule = \App\Models\Schedule::find($request->schedule_id);
        if (!$schedule) {
            return redirect()->back()->withErrors(['schedule_id' => 'Invalid schedule selected.']);
        }

        // Calculate the next date that matches the schedule's day
        $today = \Carbon\Carbon::today();
        $scheduleDay = $schedule->day;
        $daysOfWeek = ['Sunday' => 0, 'Monday' => 1, 'Tuesday' => 2, 'Wednesday' => 3, 'Thursday' => 4, 'Friday' => 5, 'Saturday' => 6];
        $targetDayOfWeek = $daysOfWeek[$scheduleDay];
        $currentDayOfWeek = $today->dayOfWeek;

        $daysUntilNext = ($targetDayOfWeek - $currentDayOfWeek + 7) % 7;
        if ($daysUntilNext == 0) {
            $daysUntilNext = 7; // If today is the day, book for next week
        }

        $bookingDate = $today->copy()->addDays($daysUntilNext);

        $appointment = Appointment::create([
            'patient_id' => Auth::user()->user_id,
            'schedule_id' => $request->schedule_id,
            'date' => $bookingDate->toDateString(),
            'status' => 'Pending',
        ]);

        return redirect()->route('medical.history')->with('success', 'Appointment successfully booked!');
    }

    public function show($id)
    {
    // This empty function will stop the "Call to undefined method" error
        return redirect()->route('medical.history');
    }

    public function destroy(Appointment $appointment)
    {
        if ($appointment->patient_id != Auth::user()->user_id) {
            abort(403);
        }

        $appointment->status = 'Cancelled';
        $appointment->save();

        return redirect()->route('appointments.index')->with('success', 'Appointment has been cancelled.');
    }

    public function clearRecords()
    {
        Appointment::whereIn('status', ['Approved', 'Declined', 'Completed', 'Cancelled'])->delete();

        return redirect()->route('appointments.index')->with('success', 'All completed appointment records have been cleared.');
    }
}