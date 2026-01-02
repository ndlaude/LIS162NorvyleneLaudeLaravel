<x-guest-layout>
    <style>
        div.min-h-screen.flex.flex-col.items-center > div:first-child:not(.w-full) {
            display: none !important;
        }
    </style>

    <div class="mb-6 p-1 bg-gray-100 rounded-lg flex gap-2">
        <a href="{{ route('login') }}" 
           class="flex-1 text-center py-2 px-4 bg-white border border-gray-300 rounded-md shadow-sm text-sm font-bold text-gray-500 uppercase hover:bg-gray-50 transition">
            Patient
        </a>
        
        <a href="{{ route('admin.login') }}" 
           class="flex-1 text-center py-2 px-4 bg-indigo-50 border-2 border-indigo-500 rounded-md shadow-sm text-sm font-bold text-indigo-700 uppercase transition">
            Admin
        </a>
    </div>

    <form method="POST" action="{{ route('admin.login.submit') }}">
        @csrf
        <div>
            <x-input-label for="email" :value="__('Admin Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" required autofocus />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Admin Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-3">
                {{ __('Admin Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>