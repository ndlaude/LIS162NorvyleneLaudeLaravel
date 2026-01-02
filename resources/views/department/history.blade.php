<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Appointment History') }}
        </h2>
    </x-slot>

    <div class="py-12 flex items-center justify-center">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white shadow-sm border border-gray-200 rounded-lg p-12 flex flex-col items-center justify-center" 
                 style="width: 500px; min-height: 300px; margin: 0 auto;">
                
                <div class="mb-4">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>

                <h3 class="text-xl font-bold text-gray-900 mb-2">History Note</h3>
                
                <p class="text-gray-600 text-center leading-relaxed">
                    This page is currently under development. Soon, you will be able to see all your previous completed, cancelled, and missed appointments here.
                </p>

                <a href="{{ route('department.index') }}" class="mt-6 text-sm font-semibold text-blue-600 hover:text-blue-800">
                    &larr; Return to Departments
                </a>
            </div>

        </div>
    </div>
</x-app-layout>