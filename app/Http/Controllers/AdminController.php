<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    // Add this function
    public function manageDoctors(Request $request)
    {
        // Fetch all approved appointments with doctor and schedule info
        $bookedAppointments = Appointment::with(['schedule.doctor', 'schedule.doctor.departments'])
            ->where('status', 'Approved')
            ->get()
            ->map(function ($appointment) {
                return [
                    'doctor' => $appointment->schedule->doctor->full_name ?? 'Unknown',
                    'dept' => 'Cardiology',
                    'status' => $appointment->status,
                    'date' => $appointment->date,
                ];
            });

        return view('admin.doctors', compact('bookedAppointments')); // This will look for resources/views/admin/doctors.blade.php
    }

    public function records()
    {
        // Fetch completed, approved, and declined appointments
        $appointments = Appointment::with(['patient', 'schedule.doctor'])->whereIn('status', ['Approved', 'Declined', 'Completed'])->orderBy('date', 'desc')->get();

        return view('admin.patient-records', compact('appointments'));
    }

    public function clearRecords()
    {
        // Delete all appointments with status 'Approved', 'Declined', or 'Completed'
        Appointment::whereIn('status', ['Approved', 'Declined', 'Completed'])->delete();

        return redirect()->route('admin.records')->with('success', 'All patient records have been cleared.');
    }

    public function pendingRequests(Request $request, $id = null, $status = null)
    {
        // If an id and status are provided, update the DB record
        if ($id !== null && $status !== null) {
            $appointment = Appointment::find($id);
            if ($appointment) {
                $appointment->status = $status;
                $appointment->save();
            }

            return redirect()->route('admin.pending-requests')->with('success', 'Status Updated');
        }

        // Otherwise, fetch pending appointments from the database
        $appointments = Appointment::with(['patient', 'schedule.doctor'])->where('status', 'Pending')->orderBy('date', 'asc')->get();

        return view('admin.pending-requests', compact('appointments'));
    }
}