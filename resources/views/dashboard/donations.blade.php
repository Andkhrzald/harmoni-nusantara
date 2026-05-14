<x-dashboard-layout>
    @section('title', 'Riwayat Donasi')

    <div class="bg-white rounded-2xl shadow-sm border border-gray-50">
        <div class="p-6 sm:p-8">
            <h3 class="text-lg font-semibold text-gray-800 mb-6 flex items-center gap-2">
                <span class="material-symbols-outlined text-emerald-600">volunteer_activism</span>
                Riwayat Donasi Anda
            </h3>

            @if($donations->isEmpty())
                <div class="text-center py-12">
                    <span class="material-symbols-outlined text-5xl text-gray-300">redeem</span>
                    <p class="text-gray-500 mt-3">Anda belum memiliki riwayat donasi.</p>
                    <a href="{{ route('aksi.donasi.index') }}" class="inline-flex items-center gap-1 mt-4 text-sm text-primary hover:text-primary-700 font-medium">
                        Lihat Campaign Donasi
                        <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </a>
                </div>
            @else
                <div class="overflow-hidden">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-gray-100 text-left text-gray-400 font-medium">
                                <th class="pb-3 pr-4">Campaign</th>
                                <th class="pb-3 pr-4">Tanggal</th>
                                <th class="pb-3 pr-4">Status</th>
                                <th class="pb-3 text-right">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach($donations as $donation)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="py-3 pr-4">
                                        <p class="font-medium text-gray-800">{{ $donation->project->title ?? 'Campaign Tidak Ditemukan' }}</p>
                                    </td>
                                    <td class="py-3 pr-4 text-gray-500">{{ $donation->created_at->format('d M Y') }}</td>
                                    <td class="py-3 pr-4">
                                        <span @class([
                                            'inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium',
                                            'bg-green-50 text-green-700' => $donation->payment_status === 'success',
                                            'bg-red-50 text-red-700' => $donation->payment_status === 'failed',
                                            'bg-yellow-50 text-yellow-700' => $donation->payment_status === 'pending',
                                        ])>
                                            <span class="w-1.5 h-1.5 rounded-full currentColor"></span>
                                            {{ ucfirst($donation->payment_status) }}
                                        </span>
                                    </td>
                                    <td class="py-3 text-right">
                                        <span class="font-semibold text-gray-800">Rp {{ number_format($donation->amount, 0, ',', '.') }}</span>
                                        @if($donation->anonymous_flag)
                                            <span class="block text-xs text-gray-400">Anonim</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</x-dashboard-layout>
