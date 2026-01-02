<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="p-4 sm:p-8">
                <h3 class="text-2xl tracking-tighter uppercase text-gray-800" style="font-weight: 900 !important;">
                    Welcome, {{ Auth::user()->full_name }}!
                </h3>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                
                {{-- Top Welcome Card --}}
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg lg:col-span-2">
                    <h4 class="text-xl font-bold mb-4 text-blue-800">What would you want to do?</h4>
                    <p class="text-gray-600 leading-relaxed text-lg">
                        Using the sidebar, you may request for a new consultation, view/edit your pending consultation requests, and view/cancel/request for reschedule of your upcoming appointments.
                    </p>
                    <p class="mt-6 font-medium text-gray-500 italic">
                        You can also see your next appointment below.
                    </p>
                </div>

                {{-- Appointment Status Table --}}
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg lg:col-span-2">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
                        <h4 style="font-weight:800; color: #1f2937; text-transform: uppercase; font-size: 14px; letter-spacing: 0.05em;">
                            Appointment Status
                        </h4>
                        {{-- Shows Today's Date --}}
                        <span style="font-size: 12px; font-weight: 700; color: #6b7280;">{{ now()->format('M d, Y') }}</span>
                    </div>

                    <div style="border:1px solid #d1d5db; border-radius:8px; padding:20px; background-color: #f9fafb;">
                        @isset($nextAppointment)
                            @php
                                $doctorName = data_get($nextAppointment, 'schedule.doctor.full_name') ?: data_get($nextAppointment, 'doctor.full_name');
                                $dept = data_get($nextAppointment, 'schedule.doctor.departments.0.department_name') ?: 'Unknown';
                                $room = data_get($nextAppointment, 'schedule.doctor.departments.0.location') ?: null;
                                $day = \Carbon\Carbon::parse(data_get($nextAppointment, 'date'))->format('l');
                                $time = data_get($nextAppointment, 'schedule.time') ?: data_get($nextAppointment, 'time') ?: '';
                                $date = \Carbon\Carbon::parse(data_get($nextAppointment, 'date'))->format('M d, Y');
                                $status = strtoupper(data_get($nextAppointment, 'status', 'Pending'));
                            @endphp

                            <table style="width:100%; border-collapse:collapse;">
                                <thead>
                                    <tr>
                                        <th style="border-bottom:2px solid #e5e7eb; padding-bottom:10px; text-align:left; font-size: 11px; color: #9ca3af; text-transform: uppercase;">Department / Location</th>
                                        <th style="border-bottom:2px solid #e5e7eb; padding-bottom:10px; text-align:left; font-size: 11px; color: #9ca3af; text-transform: uppercase;">Assigned Doctor</th>
                                        <th style="border-bottom:2px solid #e5e7eb; padding-bottom:10px; text-align:left; font-size: 11px; color: #9ca3af; text-transform: uppercase;">Schedule</th>
                                        <th style="border-bottom:2px solid #e5e7eb; padding-bottom:10px; text-align:right; font-size: 11px; color: #9ca3af; text-transform: uppercase;">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="border-bottom: 1px solid #e5e7eb;">
                                        <td style="padding:16px 0;">
                                            <div style="font-size: 14px; font-weight: 700; color: #111827;">{{ $dept }}</div>
                                            @if($room)
                                                <div style="font-size: 12px; color: #2563eb; font-weight: 600;">{{ $room }}</div>
                                            @endif
                                        </td>
                                        <td style="padding:16px 0;">
                                            <div style="font-size: 13px; font-weight: 600; color: #374151;">{{ $doctorName ?? 'TBD' }}</div>
                                        </td>
                                        <td style="padding:16px 0;">
                                            <div style="font-size: 13px; color: #111827; font-weight: 800;">
                                                {{ $day }}
                                            </div>
                                            <div style="font-size: 12px; color: #4b5563; font-weight: 500;">{{ $time }}</div>
                                            <div style="font-size: 11px; color: #9ca3af; margin-top: 2px;">{{ $date }}</div>
                                        </td>
                                        <td style="padding:16px 0; text-align: right;">
                                            @if($status === 'APPROVED')
                                                <span style="color: #16a34a; font-weight: 800; font-size: 10px; background: #f0fdf4; padding: 4px 10px; border-radius: 9999px; border: 1px solid #dcfce7; letter-spacing: 0.05em;">{{ $status }}</span>
                                            @elseif($status === 'PENDING')
                                                <span style="color: #ca8a04; font-weight: 800; font-size: 10px; background: #fefce8; padding: 4px 10px; border-radius: 9999px; border: 1px solid #fef08a; letter-spacing: 0.05em;">{{ $status }}</span>
                                            @else
                                                <span style="color: #6b7280; font-weight: 700; font-size: 10px; background: #f3f4f6; padding: 4px 10px; border-radius: 9999px; border: 1px solid #e5e7eb; letter-spacing: 0.05em;">{{ $status }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        @else
                            <div style="text-align:center; padding:40px 0; color:#6b7280;">
                                <div style="font-weight:800; font-size:16px; color:#111827;">No upcoming appointments</div>
                                <div style="margin-top:8px;">You have no scheduled appointments. Use the sidebar to request one.</div>
                            </div>
                        @endisset
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>