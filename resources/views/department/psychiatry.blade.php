<x-app-layout>
    <x-slot name="header">
        <h2 style="font-weight:600; font-size:18px; color:#1f2937;">
            View Doctors - Psychiatry
        </h2>
    </x-slot>

    <div style="padding:48px 0;">
        @include('partials.alerts')

        {{-- Hidden form for booking --}}
        <form id="booking-form" action="{{ route('appointments.store') }}" method="POST" style="display: none;">
            @csrf
            <input type="hidden" name="schedule_id" id="schedule-id-input">
            <input type="hidden" name="appointment_date" value="{{ date('Y-m-d') }}">
        </form>

        <div style="max-width:1120px; margin:0 auto; padding:0 16px;">
            <div style="background:white; box-shadow:0 1px 3px rgba(0,0,0,0.1); border-radius:8px; padding:24px;">

                {{-- Department info --}}
                <table style="margin-bottom:16px;">
                    <tr>
                        <th style="text-align:left; padding-right:8px; color: #6b7280; font-size: 14px;">Location</th>
                        <td>:</td>
                        <td style="padding-left:8px; font-weight: 600;">{{ $department->location }}</td>
                    </tr>
                    <tr>
                        <th style="text-align:left; padding-right:8px; color: #6b7280; font-size: 14px;">Department Name</th>
                        <td>:</td>
                        <td style="padding-left:8px; font-weight: 600;">{{ $department->department_name }}</td>
                    </tr>
                </table>

                <hr style="margin:20px 0; border:0; border-top:1px solid #e5e7eb;">

                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                    <h3 style="font-size:16px; font-weight:600;">Available Specialists</h3>
                    <a href="{{ route('department.index') }}" style="font-size: 13px; color: #2563eb; text-decoration: none;">← Back to Departments</a>
                </div>

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
                        @php
                            $doctors = [
                                ['id' => 20, 'name' => 'Dr. Carlo Mendoza', 'day' => 'Monday', 'time' => '1:00 PM – 4:00 PM'],
                                ['id' => 21, 'name' => 'Dr. Nina Flores', 'day' => 'Tuesday', 'time' => '9:00 AM – 12:00 PM'],
                                ['id' => 22, 'name' => 'Dr. Mark Villanueva', 'day' => 'Wednesday', 'time' => '2:00 PM – 6:00 PM'],
                                ['id' => 23, 'name' => 'Dr. Paul Navarro', 'day' => 'Friday', 'time' => '1:00 PM – 5:00 PM'],
                                ['id' => 24, 'name' => 'Dr. Elena Rossi', 'day' => 'Thursday', 'time' => '10:00 AM – 1:00 PM'],
                            ];
                        @endphp
                        @foreach ($doctors as $doc)
                            <tr style="border-bottom: 1px solid #e5e7eb;">
                                <td style="border:1px solid #d1d5db; padding:12px 10px; font-weight: 500;">{{ $doc['name'] }}</td>
                                <td style="border:1px solid #d1d5db; padding:10px; text-align:center; color: #4b5563;">{{ $doc['day'] }}</td>
                                <td style="border:1px solid #d1d5db; padding:10px; text-align:center; color: #4b5563;">{{ $doc['time'] }}</td>
                                <td style="border:1px solid #d1d5db; padding:10px; text-align:center;">
                                    <button type="button" class="book-btn" data-schedule-id="{{ $doc['id'] }}"
                                        style="background:#2563eb; color:white; padding:8px 16px; border-radius:6px; font-weight:600; border:none; cursor:pointer; font-size: 12px;">
                                        Book Appointment
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <style>
        .book-btn:hover { background-color: #1d4ed8 !important; }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const bookButtons = document.querySelectorAll('.book-btn');
            const scheduleIdInput = document.getElementById('schedule-id-input');
            const bookingForm = document.getElementById('booking-form');

            bookButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const scheduleId = this.getAttribute('data-schedule-id');
                    scheduleIdInput.value = scheduleId;
                    bookingForm.submit();
                });
            });
        });
    </script>
</x-app-layout>