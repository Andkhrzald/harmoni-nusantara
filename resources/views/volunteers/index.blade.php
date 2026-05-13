<x-app-layout>
    @section('title', 'Relawan Lintas Iman')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Relawan Lintas Iman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6 mb-6">
                <h3 class="font-semibold text-lg mb-2">Bergabung dengan Relawan Harmoni Nusantara</h3>
                <p class="text-gray-600 mb-4">Wujudkan perdamaian dan toleransi lintas agama melalui aksi nyata.</p>
                <a href="{{ route('aksi.volunteers.create') }}" class="inline-block bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">
                    Daftar Jadi Relawan
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($volunteers as $volunteer)
                    <div class="bg-white shadow-sm rounded-lg p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center text-xl">
                                👤
                            </div>
                            <div class="ml-4">
                                <h4 class="font-semibold">{{ $volunteer->user->name }}</h4>
                                <p class="text-sm text-gray-500">{{ $volunteer->program_name }}</p>
                            </div>
                        </div>
                        <p class="text-sm text-gray-600 line-clamp-3">{{ $volunteer->motivation }}</p>
                        <span class="inline-block mt-3 text-xs bg-green-100 text-green-800 px-2 py-1 rounded">
                            {{ ucfirst($volunteer->status) }}
                        </span>
                    </div>
                @empty
                    <p class="text-gray-500 col-span-3">Belum ada relator terdaftar.</p>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $volunteers->links() }}
            </div>
        </div>
    </div>
</x-app-layout>