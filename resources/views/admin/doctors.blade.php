@extends('layouts.admin')

@section('content')
@php
    // 1. HANDLE DATE LOGIC
    $selectedDate = request('date') ? \Carbon\Carbon::parse(request('date')) : now();
    $startOfWeek = $selectedDate->copy()->startOfWeek();
    $endOfWeek = $selectedDate->copy()->endOfWeek();
    $weekNumber = (int)$startOfWeek->format('W');

    // 2. DATA SOURCE: Pulling from the database via controller
    // If no data passed, defaults to empty array
    $bookedAppointments = $bookedAppointments ?? [];

    // 3. DOCTOR DATA (Static Schedule)
    $departments = [
        'Cardiology' => [
            ['name' => 'Dr. Juan Dela Cruz', 'day' => 'Monday', 'time' => '9:00 AM – 12:00 PM'],
            ['name' => 'Dr. Maria Santos', 'day' => 'Tuesday', 'time' => '1:00 PM – 5:00 PM'],
            ['name' => 'Dr. Ana Reyes', 'day' => 'Wednesday', 'time' => '8:00 AM – 11:00 AM'],
            ['name' => 'Dr. Pedro Cruz', 'day' => 'Thursday', 'time' => '10:00 AM – 2:00 PM'],
            ['name' => 'Dr. Liza Gomez', 'day' => 'Friday', 'time' => '9:00 AM – 12:00 PM'],
        ],
        'Dermatology' => [
            ['name' => 'Dr. Clara Skin', 'day' => 'Wednesday', 'time' => '10:00 AM – 3:00 PM'],
        ],
        'General Surgery' => [
            ['name' => 'Dr. Juan Dela Cruz', 'day' => 'Monday', 'time' => '9:00 AM – 12:00 PM'],
            ['name' => 'Dr. Maria Santos', 'day' => 'Tuesday', 'time' => '1:00 PM – 5:00 PM'],
            ['name' => 'Dr. Carlo Mendoza', 'day' => 'Monday', 'time' => '1:00 PM – 4:00 PM'],
            ['name' => 'Dr. Robert Bone', 'day' => 'Monday', 'time' => '10:00 AM – 2:00 PM'],
            ['name' => 'Dr. Alice Ray', 'day' => 'Tuesday', 'time' => '9:00 AM – 12:00 PM'],
            ['name' => 'Dr. Hope Cell', 'day' => 'Monday', 'time' => '8:00 AM – 11:00 AM'],
            ['name' => 'Dr. Nina Flores', 'day' => 'Tuesday', 'time' => '9:00 AM – 12:00 PM'],
        ],
        'Neurology' => [
            ['name' => 'Dr. Carlo Mendoza', 'day' => 'Monday', 'time' => '1:00 PM – 4:00 PM'],
            ['name' => 'Dr. Nina Flores', 'day' => 'Tuesday', 'time' => '9:00 AM – 12:00 PM'],
            ['name' => 'Dr. Mark Villanueva', 'day' => 'Wednesday', 'time' => '2:00 PM – 6:00 PM'],
            ['name' => 'Dr. Elena Rossi', 'day' => 'Thursday', 'time' => '10:00 AM – 1:00 PM'],
            ['name' => 'Dr. Paul Navarro', 'day' => 'Friday', 'time' => '1:00 PM – 5:00 PM'],
        ],
        'Oncology' => [
            ['name' => 'Dr. Hope Cell', 'day' => 'Monday', 'time' => '8:00 AM – 11:00 AM'],
            ['name' => 'Dr. Kevin Care', 'day' => 'Thursday', 'time' => '1:00 PM – 4:00 PM'],
        ],
        'Orthopedics' => [
            ['name' => 'Dr. Robert Bone', 'day' => 'Monday', 'time' => '10:00 AM – 2:00 PM'],
            ['name' => 'Dr. Sarah Joint', 'day' => 'Wednesday', 'time' => '1:00 PM – 4:00 PM'],
        ],
        'Pediatrics' => [
            ['name' => 'Dr. Maria Santos', 'day' => 'Tuesday', 'time' => '1:00 PM – 5:00 PM'],
            ['name' => 'Dr. Sofia Ramirez', 'day' => 'Thursday', 'time' => '8:00 AM – 11:00 AM'],
        ],
        'Psychiatry' => [
            ['name' => 'Dr. Carlo Mendoza', 'day' => 'Monday', 'time' => '1:00 PM – 4:00 PM'],
            ['name' => 'Dr. Nina Flores', 'day' => 'Tuesday', 'time' => '9:00 AM – 12:00 PM'],
            ['name' => 'Dr. Mark Villanueva', 'day' => 'Wednesday', 'time' => '2:00 PM – 6:00 PM'],
            ['name' => 'Dr. Elena Rossi', 'day' => 'Thursday', 'time' => '10:00 AM – 1:00 PM'],
            ['name' => 'Dr. Paul Navarro', 'day' => 'Friday', 'time' => '1:00 PM – 5:00 PM'],
        ],
        'Radiology' => [
            ['name' => 'Dr. Alice Ray', 'day' => 'Tuesday', 'time' => '9:00 AM – 12:00 PM'],
            ['name' => 'Dr. Victor Scan', 'day' => 'Friday', 'time' => '2:00 PM – 5:00 PM'],
        ]
    ];
@endphp

<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">
        
        {{-- TOP BAR --}}
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; background: white; padding: 20px; border-radius: 8px; border: 1px solid #e5e7eb;">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Manage Doctor Schedules') }}
                </h2>
                <p style="font-size:14px; color: #6b7280; margin-top: 4px;">
                    Week: <strong>{{ $startOfWeek->format('M d') }} - {{ $endOfWeek->format('M d, Y') }}</strong>
                </p>
            </div>

            <form action="{{ route('admin.doctors') }}" method="GET" style="display:flex; align-items:center; gap:10px;">
                <label for="date" style="font-size:12px; font-weight:800; color:#1e293b; text-transform:uppercase;">Select Week:</label>
                <input type="date" name="date" id="date" value="{{ $selectedDate->format('Y-m-d') }}" 
                    onchange="this.form.submit()"
                    style="border:1px solid #d1d5db; border-radius:6px; padding:6px 10px; font-size:14px; color:#374151;">
                
                <a href="{{ route('admin.doctors') }}" 
                   style="background-color:#f3f4f6; color:#374151; padding:8px 12px; border-radius:6px; text-decoration:none; font-weight: 600; font-size: 12px; border: 1px solid #d1d5db;">
                    Today
                </a>
            </form>
        </div>

        @foreach($departments as $deptName => $doctorList)
            @php
                // Logic: Only appointments in the current department with status 'Approved' are counted
                $deptBookings = collect($bookedAppointments)
                    ->where('dept', $deptName)
                    ->where('status', 'Approved');

                $bookedCount = 0;
                foreach($doctorList as $doc) {
                    if($deptBookings->where('doctor', $doc['name'])->count() > 0) { $bookedCount++; }
                }
                $totalDoctors = count($doctorList);
            @endphp
            
            <div class="bg-white shadow sm:rounded-lg p-6">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">
                    <h3 style="font-size:16px; font-weight:700; color: #111827; text-transform: uppercase;">
                        {{ $deptName }} Department
                    </h3>
                    <span style="font-size:11px; font-weight:800; color: #2563eb; background: #eff6ff; padding: 4px 12px; border-radius: 9999px; border: 1px solid #dbeafe; letter-spacing: 0.05em;">
                        {{ $bookedCount }}/{{ $totalDoctors }} BOOKED
                    </span>
                </div>

                <div style="border: 1px solid #e5e7eb; border-radius: 8px; overflow: hidden;">
                    <table style="width:100%; border-collapse:collapse;">
                        <thead style="background:#f9fafb;">
                            <tr>
                                <th style="border:1px solid #d1d5db; padding:12px 10px; text-align:left; font-size: 11px; text-transform: uppercase; color: #6b7280; font-weight: 800;">Doctor</th>
                                <th style="border:1px solid #d1d5db; padding:12px 10px; text-align:left; font-size: 11px; text-transform: uppercase; color: #6b7280; font-weight: 800;">Day</th>
                                <th style="border:1px solid #d1d5db; padding:12px 10px; text-align:left; font-size: 11px; text-transform: uppercase; color: #6b7280; font-weight: 800;">Hours</th>
                                <th style="border:1px solid #d1d5db; padding:12px 10px; text-align:center; font-size: 11px; text-transform: uppercase; color: #6b7280; font-weight: 800;">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @foreach ($doctorList as $doctor)
                                @php
                                    // Check if this specific doctor has an 'Approved' status in the session
                                    $isBooked = $deptBookings->where('doctor', $doctor['name'])->count() > 0;
                                @endphp
                                <tr style="border-bottom: 1px solid #e5e7eb;">
                                    <td style="border:1px solid #d1d5db; padding:12px 10px;">
                                        <div style="font-weight: 700; color: #111827; font-size: 14px;">{{ $doctor['name'] }}</div>
                                    </td>
                                    <td style="border:1px solid #d1d5db; padding:12px 10px; color: #374151; font-weight: 600; font-size: 13px;">
                                        {{ $doctor['day'] }}
                                    </td>
                                    <td style="border:1px solid #d1d5db; padding:12px 10px; color: #6b7280; font-size: 13px;">
                                        {{ $doctor['time'] }}
                                    </td>
                                    <td style="border:1px solid #d1d5db; padding:12px 10px; text-align:center;">
                                        @if($isBooked)
                                            <span style="color: #ca8a04; font-weight: 800; font-size: 10px; background: #fefce8; padding: 4px 10px; border-radius: 4px; border: 1px solid #fef08a; text-transform: uppercase;">
                                                Booked
                                            </span>
                                        @else
                                            <span style="color: #16a34a; font-weight: 800; font-size: 10px; background: #f0fdf4; padding: 4px 10px; border-radius: 4px; border: 1px solid #dcfce7; text-transform: uppercase;">
                                                Available
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection