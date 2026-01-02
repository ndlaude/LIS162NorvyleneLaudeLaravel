<x-app-layout>
    <x-slot name="header">
        <h2 style="font-weight:600; font-size:18px; color:#1f2937;">
            View Doctors
        </h2>
    </x-slot>

    <div style="padding:48px 0;">
        <div style="max-width:1120px; margin:0 auto; padding:0 16px;">

            <div style="background:white; box-shadow:0 1px 3px rgba(0,0,0,0.1); border-radius:8px; padding:24px;">

                {{-- Department info --}}
                <table style="margin-bottom:16px;">
                    <tr>
                        <th style="text-align:left; padding-right:8px;">Location</th>
                        <td>:</td>
                        <td style="padding-left:8px;">{{ $department->location }}</td>
                    </tr>
                    <tr>
                        <th style="text-align:left; padding-right:8px;">Department Name</th>
                        <td>:</td>
                        <td style="padding-left:8px;">{{ $department->department_name }}</td>
                    </tr>
                </table>

                <hr style="margin:20px 0; border:0; border-top:1px solid #e5e7eb;">

                <h3 style="font-size:16px; font-weight:600; margin-bottom:12px;">
                    Available Doctors
                </h3>

                {{-- Doctors / Schedules table --}}
                <table style="width:100%; border-collapse:collapse;">
                    <thead style="background:#f3f4f6;">
                        <tr>
                            <th style="border:1px solid #d1d5db; padding:10px; text-align:left;">Doctor Name</th>
                            <th style="border:1px solid #d1d5db; padding:10px;">Day</th>
                            <th style="border:1px solid #d1d5db; padding:10px;">Time</th>
                            <th style="border:1px solid #d1d5db; padding:10px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($schedules) && $schedules->count())
                            @foreach($schedules as $sched)
                                <tr>
                                    <td style="border:1px solid #d1d5db; padding:10px;">{{ $sched->doctor->name ?? 'Unknown Doctor' }}</td>
                                    <td style="border:1px solid #d1d5db; padding:10px; text-align:center;">{{ $sched->day }}</td>
                                    <td style="border:1px solid #d1d5db; padding:10px; text-align:center;">{{ \Carbon\Carbon::parse($sched->time)->format('g:i A') }}</td>
                                    <td style="border:1px solid #d1d5db; padding:10px; text-align:center;">
                                        <form action="{{ route('appointments.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="schedule_id" value="{{ $sched->schedule_id }}">
                                            <input type="hidden" name="appointment_date" value="{{ date('Y-m-d') }}">
                                            <button type="submit" style="background:#2563eb; color:white; padding:6px 12px; border:none; border-radius:4px; cursor:pointer;">Book</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" style="padding: 40px; text-align:center; color:#9ca3af;">No schedules available for this department.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
