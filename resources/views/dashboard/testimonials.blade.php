<x-app-layout>
    @section('title', 'Moderasi Testimoni')
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <span class="material-symbols-outlined text-2xl text-primary">rate_review</span>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Moderasi Testimoni</h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-xl flex items-center gap-2">
                    <span class="material-symbols-outlined">check_circle</span>
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-sm border border-gray-50 overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="font-semibold text-gray-800">Daftar Testimoni</h3>
                    <p class="text-sm text-gray-400 mt-1">Kelola testimoni pengguna sebelum ditampilkan ke publik.</p>
                </div>

                @if($testimonials->isEmpty())
                    <div class="p-12 text-center text-gray-400">
                        <span class="material-symbols-outlined text-5xl mb-3">rate_review</span>
                        <p>Belum ada testimoni masuk.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="bg-gray-50 text-gray-500">
                                <tr>
                                    <th class="text-left px-6 py-3 font-medium">Status</th>
                                    <th class="text-left px-6 py-3 font-medium">Nama</th>
                                    <th class="text-left px-6 py-3 font-medium">Avatar</th>
                                    <th class="text-left px-6 py-3 font-medium">Judul</th>
                                    <th class="text-left px-6 py-3 font-medium">Cerita</th>
                                    <th class="text-left px-6 py-3 font-medium">Tanggal</th>
                                    <th class="text-right px-6 py-3 font-medium">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($testimonials as $testimonial)
                                    <tr class="hover:bg-gray-50/50 transition-colors">
                                        <td class="px-6 py-4">
                                            @if($testimonial->is_approved)
                                                <span class="inline-flex items-center gap-1 text-xs bg-green-100 text-green-700 px-2.5 py-1 rounded-full font-medium">
                                                    <span class="material-symbols-outlined text-sm">check_circle</span>
                                                    Disetujui
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1 text-xs bg-amber-100 text-amber-700 px-2.5 py-1 rounded-full font-medium">
                                                    <span class="material-symbols-outlined text-sm">pending</span>
                                                    Menunggu
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 font-medium text-gray-800">{{ $testimonial->name }}</td>
                                        <td class="px-6 py-4">
                                            @if($testimonial->user && $testimonial->user->avatar)
                                                <img src="{{ Storage::url($testimonial->user->avatar) }}" alt="{{ $testimonial->name }}" class="w-10 h-10 rounded-full object-cover">
                                            @else
                                                <span class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center text-primary font-bold text-sm">
                                                    {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-gray-600">
                                            <span class="text-sm">{{ $testimonial->title ?? '-' }}</span>
                                        </td>
                                        <td class="px-6 py-4 text-gray-600 max-w-xs">
                                            <p class="line-clamp-2">{{ $testimonial->content }}</p>
                                        </td>
                                        <td class="px-6 py-4 text-gray-400 text-xs">{{ $testimonial->created_at->format('d M Y H:i') }}</td>
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex items-center justify-end gap-2">
                                                @if(!$testimonial->is_approved)
                                                    <form action="{{ route('dashboard.testimoni.approve', $testimonial->id) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="inline-flex items-center gap-1 text-xs bg-green-50 text-green-600 hover:bg-green-100 px-3 py-1.5 rounded-lg font-medium transition-colors">
                                                            <span class="material-symbols-outlined text-sm">check</span>
                                                            Setujui
                                                        </button>
                                                    </form>
                                                @endif
                                                <form action="{{ route('dashboard.testimoni.reject', $testimonial->id) }}" method="POST" onsubmit="return confirm('Hapus testimoni ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center gap-1 text-xs bg-red-50 text-red-600 hover:bg-red-100 px-3 py-1.5 rounded-lg font-medium transition-colors">
                                                        <span class="material-symbols-outlined text-sm">delete</span>
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <div class="flex items-center gap-2 text-sm text-gray-400">
                <span class="material-symbols-outlined text-sm">info</span>
                <span>Testimoni harus disetujui admin sebelum tampil di halaman utama.</span>
            </div>
        </div>
    </div>
</x-app-layout>
