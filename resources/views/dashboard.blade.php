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
            @if(Auth::user()->role == 'admin')
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-semibold mb-4">Ringkasan</h3>
                        <div class="grid grid-cols-4 gap-4">
                            <div class="bg-gray-100 p-4 rounded">
                                <h4>Total Produk</h4>
                                <p class="text-2xl font-bold">0</p>
                            </div>
                            <div class="bg-gray-100 p-4 rounded">
                                <h4>Pesanan Baru</h4>
                                <p class="text-2xl font-bold">0</p>
                            </div>
                            <div class="bg-gray-100 p-4 rounded">
                                <h4>Perlu Dikirim</h4>
                                <p class="text-2xl font-bold">0</p>
                            </div>
                            <div class="bg-gray-100 p-4 rounded">
                                <h4>Total Pelanggan</h4>
                                <p class="text-2xl font-bold">0</p>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <script>window.location = "{{ route('dashboard') }}";</script>
            @endif
        </div>
    </div>
</x-app-layout>
