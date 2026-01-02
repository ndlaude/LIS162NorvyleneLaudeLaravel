<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Appointments') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">

                <div style="margin-bottom: 20px;">
                    <h3 style="font-size:16px; font-weight:700; color: #111827; text-transform: uppercase;">
                        {{ $title ?? 'Appointment List' }}
                    </h3>
                </div>

                {{-- Success Message Alert --}}
                @if(session('success'))
                    <div style="background: #dcfce7; color: #166534; padding: 10px; border-radius: 6px; margin-bottom: 20px; font-size: 14px; border: 1px solid #bbf7d0;">
                        {{ session('success') }}
                    </div>
                @endif

                @if($appointments->count() > 0)
                    <div style="margin-bottom: 20px; text-align: right;">
                        <form action="{{ route('appointments.clear') }}" method="POST" onsubmit="return confirm('Are you sure you want to clear all completed appointment records? This action cannot be undone.')">
                            @csrf
                            <button type="submit" style="color: #dc2626; font-weight: 600; font-size: 14px; background: #fef2f2; padding: 8px 16px; border: 1px solid #fecaca; border-radius: 4px; cursor: pointer;">
                                Clear Completed Records
                            </button>
                        </form>
                    </div>

                    <table style="width:100%; border-collapse:collapse; border: 1px solid #e5e7eb;">
                        <thead style="background:#f9fafb;">
                            <tr>
                                <th style="border:1px solid #d1d5db; padding:12px; text-align:left; font-size:13px; color:#6b7280; text-transform:uppercase;">Appointment ID</th>
                                <th style="border:1px solid #d1d5db; padding:12px; text-align:left; font-size:13px; color:#6b7280; text-transform:uppercase;">Doctor</th>
                                <th style="border:1px solid #d1d5db; padding:12px; text-align:left; font-size:13px; color:#6b7280; text-transform:uppercase;">Date</th>
                                <th style="border:1px solid #d1d5db; padding:12px; text-align:center; font-size:13px; color:#6b7280; text-transform:uppercase;">Status</th>
                                <th style="border:1px solid #d1d5db; padding:12px; text-align:center; font-size:13px; color:#6b7280; text-transform:uppercase;">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @foreach($appointments as $appointment)
                            <tr style="border-bottom: 1px solid #e5e7eb;">
                                <td style="border:1px solid #d1d5db; padding:12px 10px;">
                                    {{ $appointment->appointment_id }}
                                </td>
                                <td style="border:1px solid #d1d5db; padding:12px 10px;">
                                    {{ $appointment->schedule->doctor->name ?? 'Unknown Doctor' }}
                                </td>
                                <td style="border:1px solid #d1d5db; padding:12px 10px;">
                                    {{ \Carbon\Carbon::parse($appointment->date)->format('M d, Y') }}
                                </td>
                                <td style="border:1px solid #d1d5db; padding:12px 10px; text-align:center;">
                                    @php
                                        $status = $appointment->status ?? 'Pending';
                                        $color = $status == 'Approved' ? '#16a34a' : ($status == 'Declined' ? '#dc2626' : '#ca8a04');
                                        $bg = $status == 'Approved' ? '#f0fdf4' : ($status == 'Declined' ? '#fef2f2' : '#fefce8');
                                    @endphp
                                    <span style="color: {{ $color }}; background: {{ $bg }}; font-weight: 800; font-size: 10px; padding: 4px 8px; border-radius: 4px; border: 1px solid; text-transform: uppercase;">
                                        {{ $status }}
                                    </span>
                                </td>
                                <td style="border:1px solid #d1d5db; padding:12px 10px; text-align:center;">
                                    @if($appointment->status !== 'Declined' && $appointment->status !== 'Cancelled')
                                        <form action="{{ route('appointments.destroy', $appointment->appointment_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this appointment?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="color:#dc2626; font-weight:600; font-size:13px; text-decoration:underline; background:none; border:none; cursor:pointer;">
                                                Cancel
                                            </button>
                                        </form>
                                    @else
                                        <span style="color:#9ca3af; font-size:13px;">No Action</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p style="text-align: center; color: #6b7280; font-size: 14px; padding: 20px;">
                        No appointments found. <a href="{{ route('department.index') }}" style="color: #2563eb;">Book one now</a>.
                    </p>
                @endif

                <div style="margin-top:25px; padding-top: 15px; border-top: 1px solid #f3f4f6;">
                    <a href="{{ route('department.index') }}"
                       style="display: inline-flex; align-items: center; color:#2563eb; text-decoration:none; font-size:14px; font-weight: 700;">
                        ← Back to Departments
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
