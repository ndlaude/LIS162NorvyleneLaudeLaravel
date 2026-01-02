@extends('layouts.admin')

@section('content')

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Patient Records') }}
    </h2>
</x-slot>

<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="mb-6">
            <h1 class="text-2xl font-black text-slate-800 tracking-tight">
                {{ now()->format('l, M d, Y') }}
            </h1>
            <p class="text-sm font-bold text-gray-400 uppercase tracking-widest">Patient Appointment History</p>
        </div>

        <div class="bg-white shadow sm:rounded-lg p-6">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h3 style="font-size:16px; font-weight:700; color: #111827; text-transform: uppercase;">
                    Completed & Cancelled Appointments
                </h3>
                <form action="{{ route('admin.records.clear') }}" method="POST" onsubmit="return confirm('Are you sure you want to clear all patient records? This action cannot be undone.');">
                    @csrf
                    <button type="submit" style="color: #dc2626; font-weight: 800; font-size: 12px; background: #fef2f2; padding: 8px 16px; border-radius: 4px; border: 1px solid #fee2e2; cursor: pointer;">Clear All Records</button>
                </form>
            </div>

            <div style="border: 1px solid #e5e7eb; border-radius: 8px; overflow: hidden;">
                <table style="width:100%; border-collapse:collapse;">
                    <thead style="background:#f9fafb;">
                        <tr>
                            <th style="border:1px solid #d1d5db; padding:12px 10px; text-align:left; font-size: 11px; text-transform: uppercase; color: #6b7280; font-weight: 800;">Patient</th>
                            <th style="border:1px solid #d1d5db; padding:12px 10px; text-align:left; font-size: 11px; text-transform: uppercase; color: #6b7280; font-weight: 800;">Doctor & Schedule</th>
                            <th style="border:1px solid #d1d5db; padding:12px 10px; text-align:center; font-size: 11px; text-transform: uppercase; color: #6b7280; font-weight: 800;">Date</th>
                            <th style="border:1px solid #d1d5db; padding:12px 10px; text-align:center; font-size: 11px; text-transform: uppercase; color: #6b7280; font-weight: 800;">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @forelse($appointments as $appt)
                        <tr style="border-bottom: 1px solid #e5e7eb;">
                            <td style="border:1px solid #d1d5db; padding:12px 10px;">
                                <div style="font-weight: 700; color: #111827; font-size: 14px;">{{ $appt->patient->name ?? 'Unknown' }}</div>
                                <div style="font-size: 11px; color: #2563eb; font-weight: 600;">ID: #{{ $appt->appointment_id }}</div>
                            </td>
                            <td style="border:1px solid #d1d5db; padding:12px 10px;">
                                <div style="font-size: 13px; color: #374151; font-weight: 600;">{{ $appt->schedule->doctor->name ?? 'Unknown Doctor' }}</div>
                                <div style="font-size: 11px; color: #111827; font-weight: 800;">{{ $appt->schedule->day ?? 'N/A' }} | {{ \Carbon\Carbon::parse($appt->schedule->time ?? '00:00:00')->format('g:i A') }}</div>
                            </td>
                            <td style="border:1px solid #d1d5db; padding:12px 10px; text-align:center; color: #374151; font-weight: 600; font-size: 13px;">
                                {{ \Carbon\Carbon::parse($appt->date)->format('M d, Y') }}
                            </td>
                            <td style="border:1px solid #d1d5db; padding:12px 10px; text-align:center;">
                                @php
                                    $status = $appt->status ?? 'Pending';
                                    $color = $status == 'Approved' ? '#16a34a' : ($status == 'Declined' ? '#dc2626' : '#ca8a04');
                                    $bg = $status == 'Approved' ? '#f0fdf4' : ($status == 'Declined' ? '#fef2f2' : '#fefce8');
                                @endphp
                                <span style="color: {{ $color }}; background: {{ $bg }}; font-weight: 800; font-size: 10px; padding: 4px 8px; border-radius: 4px; border: 1px solid; text-transform: uppercase;">
                                    {{ $status }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="border:1px solid #d1d5db; padding:20px; text-align:center; color: #6b7280; font-size: 14px;">
                                No completed or cancelled appointments found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
