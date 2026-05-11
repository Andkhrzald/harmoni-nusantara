<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Donasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-6">Riwayat Donasi Anda</h3>

                    @if($donations->isEmpty())
                        <p class="text-gray-500">Anda belum memiliki riwayat donasi.</p>
                    @else
                        <div class="space-y-4">
                            @foreach($donations as $donation)
                                <div class="border-b pb-4">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h4 class="font-medium">{{ $donation->project->title ?? 'Campaign Tidak Ditemukan' }}</h4>
                                            <p class="text-sm text-gray-500">
                                                {{ $donation->created_at->format('d M Y') }}
                                                @if($donation->anonymous_flag)
                                                    <span class="ml-2">(Anonim)</span>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="text-right">
                                            <span class="font-semibold">Rp {{ number_format($donation->amount, 0, ',', '.') }}</span>
                                            <span class="block text-sm
                                                @if($donation->payment_status === 'success') text-green-600
                                                @elseif($donation->payment_status === 'failed') text-red-600
                                                @else text-yellow-600 @endif">
                                                {{ ucfirst($donation->payment_status) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>