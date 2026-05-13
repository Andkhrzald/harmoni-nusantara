<x-app-layout>
    @section('title', $project->title)
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $project->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6 mb-6">
                <div class="mb-4">
                    <span class="bg-{{ $project->status === 'active' ? 'green' : 'gray' }}-100 text-{{ $project->status === 'active' ? 'green' : 'gray' }}-800 text-sm px-3 py-1 rounded-full">
                        {{ ucfirst($project->status) }}
                    </span>
                </div>

                <p class="text-gray-700 mb-6">{{ $project->description }}</p>

                <div class="mb-6">
                    <div class="w-full bg-gray-200 rounded-full h-4">
                        <div class="bg-indigo-600 h-4 rounded-full" style="width: {{ $stats['percentage'] }}%"></div>
                    </div>
                    <div class="flex justify-between mt-2 text-sm">
                        <span class="text-gray-600">Rp {{ number_format($stats['total_raised'], 0, ',', '.') }} terkumpul</span>
                        <span class="text-gray-600">{{ $stats['percentage'] }}%</span>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-4 text-center text-sm">
                    <div class="p-3 bg-gray-50 rounded-lg">
                        <p class="text-gray-500">Donatur</p>
                        <p class="font-bold text-lg">{{ $stats['donor_count'] }}</p>
                    </div>
                    <div class="p-3 bg-gray-50 rounded-lg">
                        <p class="text-gray-500">Target</p>
                        <p class="font-bold text-lg">Rp {{ number_format($project->target_amount, 0, ',', '.') }}</p>
                    </div>
                    <div class="p-3 bg-gray-50 rounded-lg">
                        <p class="text-gray-500">Sisa Hari</p>
                        <p class="font-bold text-lg">{{ $stats['days_left'] ?? '-' }}</p>
                    </div>
                </div>
            </div>

            @auth
            <div class="bg-white shadow-sm rounded-lg p-6">
                <h3 class="font-semibold text-lg mb-4">Donasi Sekarang</h3>
                <form action="{{ route('aksi.donasi.donate', $project->id) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Donasi</label>
                        <input type="number" name="amount" min="1000" class="w-full border rounded-lg px-4 py-2" placeholder="Masukkan jumlah" required>
                    </div>
                    <div class="mb-4">
                        <label class="flex items-center">
                            <input type="checkbox" name="anonymous" class="rounded border-gray-300">
                            <span class="ml-2 text-sm text-gray-600">Donasi sebagai anonim</span>
                        </label>
                    </div>
                    <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700">
                        Donasi Sekarang
                    </button>
                </form>
            </div>
            @else
            <div class="bg-indigo-50 p-6 rounded-lg text-center">
                <p class="text-indigo-700">Silakan <a href="{{ route('login') }}" class="underline">login</a> untuk berdonasi.</p>
            </div>
            @endauth
        </div>
    </div>
</x-app-layout>