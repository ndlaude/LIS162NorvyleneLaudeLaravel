<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display the list of departments.
     */
    public function index()
    {
        $departments = Department::orderBy('location', 'ASC')->get();
        return view('department.index', compact('departments'));
    }

    /**
     * Show the form for creating a new department.
     */
    public function create()
    {
        return view('department.create');
    }

    /**
     * Store a newly created department in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'location' => $request->input('location'),
            'department_name' => $request->input('department_name'),
        ];

        Department::firstOrCreate($data);

        return redirect(route('department.index'));
    }

    /**
     * Display doctors under the selected department.
     * (Triggered by "VIEW DOCTORS")
     */
    public function show(Department $department)
    {
        // Find doctors linked to this department via the pivot table
        $doctorIds = \DB::table('doctor_dept')
            ->where('department_id', $department->department_id)
            ->pluck('doctor_id')
            ->toArray();

        // Fetch schedules for those doctors
        $schedules = [];
        if (!empty($doctorIds)) {
            $schedules = \App\Models\Schedule::with('doctor')
                ->whereIn('doctor_id', $doctorIds)
                ->orderBy('day')
                ->orderBy('time')
                ->get();
        }

        return view('department.show', compact('department', 'schedules'));
    }

    /**
     * Show the form for editing the department schedule.
     * (Triggered by "EDIT SCHEDULE")
     */
    public function edit(Department $department)
    {
        return view('department.edit', compact('department'));
    }

    /**
     * Update the department schedule/details.
     */
    public function update(Request $request, Department $department)
    {
        $data = [
            'schedule_from' => $request->input('schedule_from'),
            'schedule_to'   => $request->input('schedule_to'),
        ];

        $department->update($data);

        return redirect(route('department.index'));
    }

    
    public function destroy(Department $department)
    {
        $department->delete();
        return redirect(route('department.index'));
    }

    /**
     * Display doctors under the Cardiology department.
     */
    public function cardiology()
    {
        // Find the Cardiology department
        $department = Department::where('department_name', 'Cardiology')->first();

        if (!$department) {
            abort(404, 'Cardiology department not found.');
        }

        // Find doctors linked to this department via the pivot table
        $doctorIds = \DB::table('doctor_dept')
            ->where('department_id', $department->department_id)
            ->pluck('doctor_id')
            ->toArray();

        // Fetch schedules for those doctors
        $schedules = [];
        if (!empty($doctorIds)) {
            $schedules = \App\Models\Schedule::with('doctor')
                ->whereIn('doctor_id', $doctorIds)
                ->orderBy('day')
                ->orderBy('time')
                ->get();
        }

        return view('department.cardiology', compact('department', 'schedules'));
    }

    /**
     * Display doctors under the Neurology department.
     */
    public function neurology()
    {
        $department = Department::where('department_name', 'Neurology')->first();

        if (!$department) {
            abort(404, 'Neurology department not found.');
        }

        $doctorIds = \DB::table('doctor_dept')
            ->where('department_id', $department->department_id)
            ->pluck('doctor_id')
            ->toArray();

        $schedules = [];
        if (!empty($doctorIds)) {
            $schedules = \App\Models\Schedule::with('doctor')
                ->whereIn('doctor_id', $doctorIds)
                ->orderBy('day')
                ->orderBy('time')
                ->get();
        }

        return view('department.neurology', compact('department', 'schedules'));
    }

    /**
     * Display doctors under the Pediatrics department.
     */
    public function pediatrics()
    {
        $department = Department::where('department_name', 'Pediatrics')->first();

        if (!$department) {
            abort(404, 'Pediatrics department not found.');
        }

        $doctorIds = \DB::table('doctor_dept')
            ->where('department_id', $department->department_id)
            ->pluck('doctor_id')
            ->toArray();

        $schedules = [];
        if (!empty($doctorIds)) {
            $schedules = \App\Models\Schedule::with('doctor')
                ->whereIn('doctor_id', $doctorIds)
                ->orderBy('day')
                ->orderBy('time')
                ->get();
        }

        return view('department.pediatrics', compact('department', 'schedules'));
    }

    /**
     * Display doctors under the Orthopedics department.
     */
    public function orthopedics()
    {
        $department = Department::where('department_name', 'Orthopedics')->first();

        if (!$department) {
            abort(404, 'Orthopedics department not found.');
        }

        $doctorIds = \DB::table('doctor_dept')
            ->where('department_id', $department->department_id)
            ->pluck('doctor_id')
            ->toArray();

        $schedules = [];
        if (!empty($doctorIds)) {
            $schedules = \App\Models\Schedule::with('doctor')
                ->whereIn('doctor_id', $doctorIds)
                ->orderBy('day')
                ->orderBy('time')
                ->get();
        }

        return view('department.orthopedics', compact('department', 'schedules'));
    }

    /**
     * Display doctors under the Radiology department.
     */
    public function radiology()
    {
        $department = Department::where('department_name', 'Radiology')->first();

        if (!$department) {
            abort(404, 'Radiology department not found.');
        }

        $doctorIds = \DB::table('doctor_dept')
            ->where('department_id', $department->department_id)
            ->pluck('doctor_id')
            ->toArray();

        $schedules = [];
        if (!empty($doctorIds)) {
            $schedules = \App\Models\Schedule::with('doctor')
                ->whereIn('doctor_id', $doctorIds)
                ->orderBy('day')
                ->orderBy('time')
                ->get();
        }

        return view('department.radiology', compact('department', 'schedules'));
    }

    /**
     * Display doctors under the Oncology department.
     */
    public function oncology()
    {
        $department = Department::where('department_name', 'Oncology')->first();

        if (!$department) {
            abort(404, 'Oncology department not found.');
        }

        $doctorIds = \DB::table('doctor_dept')
            ->where('department_id', $department->department_id)
            ->pluck('doctor_id')
            ->toArray();

        $schedules = [];
        if (!empty($doctorIds)) {
            $schedules = \App\Models\Schedule::with('doctor')
                ->whereIn('doctor_id', $doctorIds)
                ->orderBy('day')
                ->orderBy('time')
                ->get();
        }

        return view('department.oncology', compact('department', 'schedules'));
    }

    /**
     * Display doctors under the Dermatology department.
     */
    public function dermatology()
    {
        $department = Department::where('department_name', 'Dermatology')->first();

        if (!$department) {
            abort(404, 'Dermatology department not found.');
        }

        $doctorIds = \DB::table('doctor_dept')
            ->where('department_id', $department->department_id)
            ->pluck('doctor_id')
            ->toArray();

        $schedules = [];
        if (!empty($doctorIds)) {
            $schedules = \App\Models\Schedule::with('doctor')
                ->whereIn('doctor_id', $doctorIds)
                ->orderBy('day')
                ->orderBy('time')
                ->get();
        }

        return view('department.dermatology', compact('department', 'schedules'));
    }

    /**
     * Display doctors under the Psychiatry department.
     */
    public function psychiatry()
    {
        $department = Department::where('department_name', 'Psychiatry')->first();

        if (!$department) {
            abort(404, 'Psychiatry department not found.');
        }

        $doctorIds = \DB::table('doctor_dept')
            ->where('department_id', $department->department_id)
            ->pluck('doctor_id')
            ->toArray();

        $schedules = [];
        if (!empty($doctorIds)) {
            $schedules = \App\Models\Schedule::with('doctor')
                ->whereIn('doctor_id', $doctorIds)
                ->orderBy('day')
                ->orderBy('time')
                ->get();
        }

        return view('department.psychiatry', compact('department', 'schedules'));
    }

    /**
     * Display doctors under the General Surgery department.
     */
    public function generalSurgery()
    {
        $department = Department::where('department_name', 'General Surgery')->first();

        if (!$department) {
            abort(404, 'General Surgery department not found.');
        }

        $doctorIds = \DB::table('doctor_dept')
            ->where('department_id', $department->department_id)
            ->pluck('doctor_id')
            ->toArray();

        $schedules = [];
        if (!empty($doctorIds)) {
            $schedules = \App\Models\Schedule::with('doctor')
                ->whereIn('doctor_id', $doctorIds)
                ->orderBy('day')
                ->orderBy('time')
                ->get();
        }

        return view('department.general-surgery', compact('department', 'schedules'));
    }
}
