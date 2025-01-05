<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            @if(Auth::user()->role == 'admin')
                {{ __('Dashboard Admin') }}
            @else
                {{ __('Dashboard Pelanggan') }}
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1>ini dashboard admin</h1>
        </div>
    </div>
</x-app-layout>
