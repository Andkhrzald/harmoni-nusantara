@php
    $user = auth()->user();
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $room->name }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 p-4 rounded-lg bg-green-50 border border-green-200 text-green-700 text-sm">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="mb-4 p-4 rounded-lg bg-red-50 border border-red-200 text-red-700 text-sm">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('info'))
                <div class="mb-4 p-4 rounded-lg bg-blue-50 border border-blue-200 text-blue-700 text-sm">
                    {{ session('info') }}
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <!-- Header -->
                <div class="p-4 sm:p-6 border-b border-gray-100 bg-gradient-to-r from-primary/5 to-secondary/5">
                    <div class="flex items-center gap-3">
                        <span class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center">
                            <span class="material-symbols-outlined text-primary">forum</span>
                        </span>
                        <div>
                            <h3 class="font-semibold text-gray-800">{{ $room->name }}</h3>
                            <p class="text-xs text-gray-500">{{ $room->description }}</p>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col lg:flex-row">
                    <!-- Sidebar Peserta -->
                    <div class="w-full lg:w-64 border-b lg:border-b-0 lg:border-r border-gray-100 bg-gray-50/50">
                        <div class="p-4">
                            <h4 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">
                                Peserta ({{ $participants->count() }})
                            </h4>
                            <div class="space-y-2">
                                @foreach ($participants as $p)
                                    <div class="flex items-center gap-2.5">
                                        <span class="w-2 h-2 rounded-full {{ $p->status === 'active' ? 'bg-green-500' : 'bg-gray-300' }}"></span>
                                        <span class="w-7 h-7 rounded-full bg-primary/10 flex items-center justify-center text-xs font-semibold text-primary shrink-0">
                                            {{ strtoupper(substr($p->user->name, 0, 1)) }}
                                        </span>
                                        <div class="min-w-0">
                                            <p class="text-sm font-medium text-gray-700 truncate">
                                                {{ $p->user->name }}
                                                @if ($p->role === 'creator')
                                                    <span class="text-xs text-secondary ml-1">• Admin</span>
                                                @endif
                                            </p>
                                            @if ($p->user->religion_preference)
                                                <p class="text-xs text-gray-400">{{ ucfirst($p->user->religion_preference) }}</p>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            @auth
                                @if ($participant && $participant->status === 'pending')
                                    <div class="mt-4 p-3 rounded-lg bg-yellow-50 border border-yellow-100">
                                        <p class="text-xs text-yellow-700">Permintaan bergabung sedang ditinjau admin.</p>
                                    </div>
                                @elseif (!$participant)
                                    <form action="{{ route('forum.request-join') }}" method="POST" class="mt-4">
                                        @csrf
                                        <button type="submit" class="w-full text-sm bg-secondary text-white px-4 py-2.5 rounded-xl font-medium hover:bg-secondary-600 transition-colors">
                                            Minta Bergabung
                                        </button>
                                    </form>
                                @endif
                                @if ($participant && $participant->role === 'creator' && $room->participants()->where('status', 'pending')->exists())
                                    <div class="mt-4">
                                        <h5 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Pending</h5>
                                        @foreach ($room->participants()->with('user')->where('status', 'pending')->get() as $pending)
                                            <div class="flex items-center justify-between gap-2 py-1.5">
                                                <span class="text-sm text-gray-600">{{ $pending->user->name }}</span>
                                                <form action="{{ route('forum.approve', $pending->user) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="text-xs bg-green-500 text-white px-3 py-1 rounded-lg hover:bg-green-600">
                                                        Setujui
                                                    </button>
                                                </form>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            @endauth
                        </div>
                    </div>

                    <!-- Chat Area -->
                    <div class="flex-1 flex flex-col relative">
                        @guest
                            <!-- Blur overlay untuk guest -->
                            <div class="absolute inset-0 z-10 flex items-center justify-center" style="pointer-events: none;">
                                <div class="w-full h-full backdrop-blur-sm bg-white/30 absolute"></div>
                                <div class="relative z-20 bg-white p-8 rounded-2xl shadow-xl text-center max-w-md mx-4" style="pointer-events: auto;">
                                    <span class="material-symbols-outlined text-6xl text-primary">forum</span>
                                    <h2 class="text-xl font-bold mt-4 text-gray-800">Gabung Komunitas Harmoni Nusantara</h2>
                                    <p class="text-gray-500 mt-2">Mulai berdialog dengan sesama dan AI tentang agama, toleransi, dan kebersamaan.</p>
                                    <div class="flex gap-3 mt-6 justify-center">
                                        <a href="{{ route('register') }}" class="bg-primary text-white px-6 py-3 rounded-xl font-semibold hover:bg-primary-600 transition-all shadow-lg shadow-primary/20">
                                            Daftar
                                        </a>
                                        <a href="{{ route('login') }}" class="border-2 border-gray-200 text-gray-700 px-6 py-3 rounded-xl font-semibold hover:border-gray-300 transition-all">
                                            Masuk
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endguest

                        <!-- Messages -->
                        <div class="flex-1 overflow-y-auto p-4 sm:p-6 space-y-4 min-h-[400px] max-h-[600px]"
                             id="chat-messages"
                             style="{{ auth()->guest() ? 'filter: blur(12px); pointer-events: none; user-select: none;' : '' }}">
                            @forelse ($messages as $message)
                                <div class="flex items-start gap-3 {{ $message->is_ai ? '' : '' }}"
                                     id="message-{{ $message->id }}">
                                    <span class="w-8 h-8 rounded-full {{ $message->is_ai ? 'bg-gradient-to-br from-purple-500 to-pink-500' : 'bg-primary/10' }} flex items-center justify-center text-xs font-semibold {{ $message->is_ai ? 'text-white' : 'text-primary' }} shrink-0 mt-0.5">
                                        {{ $message->is_ai ? 'AI' : strtoupper(substr($message->user->name, 0, 1)) }}
                                    </span>
                                    <div class="min-w-0">
                                        <div class="flex items-baseline gap-2">
                                            <span class="text-sm font-semibold text-gray-800">
                                                {{ $message->is_ai ? 'AI Assistant' : $message->user->name }}
                                            </span>
                                            <span class="text-xs text-gray-400">
                                                {{ $message->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                        <p class="text-sm text-gray-600 mt-1 leading-relaxed whitespace-pre-wrap">{{ $message->content }}</p>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-12">
                                    <span class="material-symbols-outlined text-4xl text-gray-300">forum</span>
                                    <p class="text-gray-400 mt-2">Belum ada pesan. Jadilah yang pertama berdialog!</p>
                                </div>
                            @endforelse
                        </div>

                        <!-- Input Area -->
                        @auth
                            @if ($canPost)
                                <div class="border-t border-gray-100 p-4 sm:p-6">
                                    <form action="{{ route('forum.message') }}" method="POST" class="flex gap-3">
                                        @csrf
                                        <input type="text"
                                               name="content"
                                               required
                                               maxlength="2000"
                                               placeholder="Ketik pesan... Gunakan @ai untuk bertanya kepada AI"
                                               class="flex-1 rounded-xl border-gray-200 bg-gray-50 focus:border-primary focus:ring-primary text-sm">
                                        <button type="submit"
                                                class="bg-primary text-white px-6 py-2.5 rounded-xl font-medium hover:bg-primary-600 transition-colors flex items-center gap-2">
                                            <span class="material-symbols-outlined text-sm">send</span>
                                            <span class="hidden sm:inline">Kirim</span>
                                        </button>
                                    </form>
                                </div>
                            @else
                                <div class="border-t border-gray-100 p-4 sm:p-6 relative">
                                    <div class="absolute inset-0 backdrop-blur-sm bg-white/40 z-10 flex items-center justify-center" style="pointer-events: auto;">
                                        <div class="text-center" style="pointer-events: auto;">
                                            <p class="text-sm text-gray-500 mb-2">Kamu perlu bergabung sebagai anggota untuk menulis pesan.</p>
                                            <form action="{{ route('forum.request-join') }}" method="POST">
                                                @csrf
                                                <button type="submit" class="text-sm bg-secondary text-white px-4 py-2 rounded-lg font-medium hover:bg-secondary-600 transition-colors">
                                                    Minta Bergabung
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <input type="text"
                                           disabled
                                           placeholder="Tulis pesan..."
                                           class="w-full rounded-xl border-gray-200 bg-gray-50 text-sm opacity-50">
                                </div>
                            @endif
                        @else
                            <div class="border-t border-gray-100 p-4 sm:p-6">
                                <input type="text"
                                       disabled
                                       placeholder="Masuk untuk bergabung dalam diskusi..."
                                       class="w-full rounded-xl border-gray-200 bg-gray-50 text-sm opacity-50">
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>

    @auth
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const chat = document.getElementById('chat-messages');
                if (chat) {
                    chat.scrollTop = chat.scrollHeight;
                }
            });
        </script>
    @endauth
</x-app-layout>
