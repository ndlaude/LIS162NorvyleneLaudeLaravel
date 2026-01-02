<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book Appointment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">

                {{-- Top bar --}}
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
                    <h3 style="font-size:16px; font-weight:600; color: #374151;">
                        Select a Department
                    </h3>

                    <a href="{{ route('medical.history') }}"
                    style="background-color:#1e293b; color:white; padding:10px 16px; border-radius:6px; text-decoration:none; font-weight: 600; font-size: 14px;">
                        View Appointment History
                    </a>
                </div>

                {{-- Two-column layout --}}
                <div style="display:flex; gap:20px; align-items:flex-start;">

                    {{-- LEFT: Department table --}}
                    <div style="flex:2;">
                        <table style="width:100%; border-collapse:collapse; border: 1px solid #e5e7eb;">
                            <thead style="background:#f9fafb;">
                                <tr>
                                    <th style="border:1px solid #d1d5db; padding:12px 10px; text-align:left; font-size: 13px; text-transform: uppercase; color: #6b7280;">Department</th>
                                    <th style="border:1px solid #d1d5db; padding:12px 10px; text-align:left; font-size: 13px; text-transform: uppercase; color: #6b7280;">Location</th>
                                    <th style="border:1px solid #d1d5db; padding:12px 10px; text-align:center; font-size: 13px; text-transform: uppercase; color: #6b7280;">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @php
                                    $all_departments = [
                                        ['name' => 'Cardiology', 'room' => 'Room 12', 'id' => 'cardiology'],
                                        ['name' => 'Neurology', 'room' => 'Room 11', 'id' => 'neurology'],
                                        ['name' => 'Pediatrics', 'room' => 'Room 10', 'id' => 'pediatrics'],
                                        ['name' => 'Orthopedics', 'room' => 'Room 5', 'id' => 'orthopedics'],
                                        ['name' => 'Radiology', 'room' => 'Room 25', 'id' => 'radiology'],
                                        ['name' => 'Oncology', 'room' => 'Room 15', 'id' => 'oncology'],
                                        ['name' => 'Dermatology', 'room' => 'Room 30', 'id' => 'dermatology'],
                                        ['name' => 'Psychiatry', 'room' => 'Room 20', 'id' => 'psychiatry'],
                                        ['name' => 'General Surgery', 'room' => 'Room 2', 'id' => 'general-surgery'],
                                    ];
                                @endphp

                                @foreach ($all_departments as $dept)
                                    <tr style="border-bottom: 1px solid #e5e7eb;">
                                        <td style="border:1px solid #d1d5db; padding:12px 10px; font-weight: 700; color: #111827;">
                                            {{ $dept['name'] }}
                                        </td>
                                        <td style="border:1px solid #d1d5db; padding:12px 10px; color: #4b5563;">
                                            {{ $dept['room'] }}
                                        </td>
                                        <td style="border:1px solid #d1d5db; padding:12px 10px; text-align:center;">
                                            <a href="{{ route('department.' . $dept['id']) }}" 
                                               class="pill-button"
                                               style="display: inline-block; background-color: #eff6ff; color: #1d4ed8; padding: 6px 16px; border-radius: 9999px; font-weight: 700; text-decoration: none; font-size: 12px; border: 1px solid #dbeafe; transition: all 0.2s ease;">
                                                View Doctors
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- RIGHT: Appointment Schedule --}}
                    <div style="flex:1.2; border:1px solid #d1d5db; border-radius:8px; padding:20px; background-color: #f9fafb;">
                        <h4 style="font-weight:800; margin-bottom:15px; color: #1f2937; text-transform: uppercase; font-size: 12px; letter-spacing: 0.05em;">
                            Scheduled Appointments
                        </h4>

                        <table style="width:100%; border-collapse:collapse;">
                            <thead>
                                <tr>
                                    <th style="border-bottom:2px solid #e5e7eb; padding-bottom:10px; text-align:left; font-size: 11px; color: #9ca3af; text-transform: uppercase;">Details</th>
                                    <th style="border-bottom:2px solid #e5e7eb; padding-bottom:10px; text-align:left; font-size: 11px; color: #9ca3af; text-transform: uppercase;">Status</th>
                                    <th style="border-bottom:2px solid #e5e7eb; padding-bottom:10px; text-align:center; font-size: 11px; color: #9ca3af; text-transform: uppercase;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($appointments) && $appointments->count())
                                    @foreach($appointments as $appointment)
                                        <tr style="border-bottom: 1px solid #e5e7eb;" id="appointment-{{ $appointment->appointment_id ?? $appointment->id }}">
                                            <td style="padding:12px 0;">
                                                <div style="font-size: 13px; font-weight: 700; color: #111827;">
                                                    {{ optional(optional($appointment->schedule)->doctor)->department_name ?? '—' }}
                                                </div>
                                                <div style="font-size: 12px; font-weight: 600; color: #2563eb; margin-top: 2px;">
                                                    {{ optional(optional($appointment->schedule)->doctor)->name ?? optional($appointment->patient)->name ?? '—' }}
                                                </div>
                                                <div style="font-size: 11px; color: #6b7280; margin-top: 1px;">
                                                    @if(optional($appointment->schedule)->schedule_from && optional($appointment->schedule)->schedule_to)
                                                        {{ \Carbon\Carbon::parse($appointment->schedule->schedule_from)->format('g:i A') }} – {{ \Carbon\Carbon::parse($appointment->schedule->schedule_to)->format('g:i A') }}
                                                    @endif
                                                </div>
                                                <div style="font-size: 10px; color: #9ca3af;">Date: {{ optional($appointment)->date ? \Carbon\Carbon::parse($appointment->date)->format('M d, Y') : '—' }}</div>
                                            </td>
                                            <td style="padding:12px 0;">
                                                <span style="color: #374151; font-weight: 800; font-size: 10px; background: #f3f4f6; padding: 2px 6px; border-radius: 4px; border: 1px solid #e5e7eb;">{{ strtoupper($appointment->status ?? 'N/A') }}</span>
                                            </td>
                                            <td style="padding:12px 0; text-align: center;">
                                                @if(auth()->check() && auth()->user()->user_id == ($appointment->patient_id ?? null) && ($appointment->status ?? '') !== 'Cancelled')
                                                    <form method="POST" action="{{ route('appointments.destroy', $appointment) }}" onsubmit="return confirm('Cancel this appointment?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" style="background: none; border: 1px solid #fecaca; color: #dc2626; padding: 4px 8px; border-radius: 6px; font-size: 11px; font-weight: 700; cursor: pointer;">Cancel</button>
                                                    </form>
                                                @else
                                                    —
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="3" style="padding:18px 0; text-align:center; color:#6b7280;">No scheduled appointments</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>