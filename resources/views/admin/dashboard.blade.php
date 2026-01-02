@extends('layouts.admin')

@section('content')
    <div class="py-12 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            {{-- Simplified Welcome Section --}}
            <div class="p-4 sm:p-8">
                <h3 class="text-2xl tracking-tighter uppercase text-gray-800" style="font-weight: 900 !important;">
                    Welcome, Admin!
                </h3>
            </div>

            {{-- Info Card (Kept exactly the same) --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h4 class="text-xl font-bold mb-4 text-slate-800">Hospital Management System</h4>
                <p class="text-gray-600 leading-relaxed text-lg">
                    Use the sidebar to manage pending appointment requests, update doctor schedules, or view patient records.
                </p>
            </div>

        </div>
    </div>
@endsection