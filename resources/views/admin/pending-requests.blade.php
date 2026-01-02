@extends('layouts.admin')

@section('content')
@php
    // Expecting $appointments to be a collection of Appointment models passed from the controller
    // Each $appt has ->appointment_id, ->patient, ->schedule->doctor, ->date, ->status
@endphp

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Pending Appointment Requests') }}
    </h2>
</x-slot>

<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <div class="mb-6">
            <h1 class="text-2xl font-black text-slate-800 tracking-tight">
                {{ now()->format('l, M d, Y') }}
            </h1>
            <p class="text-sm font-bold text-gray-400 uppercase tracking-widest">Appointment Queue Overview</p>
        </div>

        <div class="bg-white shadow sm:rounded-lg p-6">
            <h3 style="font-size:16px; font-weight:700; color: #111827; text-transform: uppercase; margin-bottom: 20px;">
                Patient Booking Queue
            </h3>

            <div style="border: 1px solid #e5e7eb; border-radius: 8px; overflow: hidden;">
                <table style="width:100%; border-collapse:collapse;">
                    <thead style="background:#f9fafb;">
                        <tr>
                            <th style="border:1px solid #d1d5db; padding:12px 10px; text-align:left; font-size: 11px; text-transform: uppercase; color: #6b7280; font-weight: 800;">Patient</th>
                            <th style="border:1px solid #d1d5db; padding:12px 10px; text-align:left; font-size: 11px; text-transform: uppercase; color: #6b7280; font-weight: 800;">Doctor & Schedule</th>
                            <th style="border:1px solid #d1d5db; padding:12px 10px; text-align:center; font-size: 11px; text-transform: uppercase; color: #6b7280; font-weight: 800;">Status</th>
                            <th style="border:1px solid #d1d5db; padding:12px 10px; text-align:center; font-size: 11px; text-transform: uppercase; color: #6b7280; font-weight: 800;">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach($appointments as $appt)
                        <tr style="border-bottom: 1px solid #e5e7eb;">
                            <td style="border:1px solid #d1d5db; padding:12px 10px;">
                                <div style="font-weight: 700; color: #111827; font-size: 14px;">{{ $appt->patient ? $appt->patient->name : 'Unknown' }}</div>
                                <div style="font-size: 11px; color: #2563eb; font-weight: 600;">ID: #{{ $appt->appointment_id }}</div>
                            </td>
                            <td style="border:1px solid #d1d5db; padding:12px 10px;">
                                <div style="font-size: 13px; color: #374151; font-weight: 600;">{{ $appt->schedule && $appt->schedule->doctor ? $appt->schedule->doctor->name : 'Unknown Doctor' }}</div>
                                <div style="font-size: 11px; color: #111827; font-weight: 800;">{{ $appt->schedule ? $appt->schedule->day : 'N/A' }} | {{ $appt->schedule ? \Carbon\Carbon::parse($appt->schedule->time ?? '00:00:00')->format('g:i A') : 'N/A' }}</div>
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
                            <td style="border:1px solid #d1d5db; padding:12px 10px; text-align:center;">
                                @if(($appt->status ?? 'Pending') == 'Pending')
                                    <div style="display: flex; justify-content: center; gap: 8px;">
                                        <form action="{{ route('admin.pending-requests', [$appt->appointment_id, 'Approved']) }}" method="POST">
                                            @csrf
                                            <button type="submit" style="color: #16a34a; font-weight: 800; font-size: 10px; background: #f0fdf4; padding: 6px 12px; border-radius: 4px; border: 1px solid #dcfce7; cursor: pointer;">APPROVE</button>
                                        </form>

                                        <form action="{{ route('admin.pending-requests', [$appt->appointment_id, 'Declined']) }}" method="POST">
                                            @csrf
                                            <button type="submit" style="color: #dc2626; font-weight: 800; font-size: 10px; background: #fef2f2; padding: 6px 12px; border-radius: 4px; border: 1px solid #fee2e2; cursor: pointer;">DECLINE</button>
                                        </form>
                                    </div>
                                @else
                                    <div style="display: flex; align-items: center; justify-content: center; gap: 10px;">
                                        <span style="font-size: 10px; color: #9ca3af; font-weight: 700;">{{ strtoupper($appt->status) }}</span>
                                        <form action="{{ route('admin.pending-requests', [$appt->appointment_id, 'Pending']) }}" method="POST">
                                            @csrf
                                            <button type="submit" style="color: #6366f1; font-weight: 800; font-size: 9px; cursor: pointer;">UNDO</button>
                                        </form>
                                    </div>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection