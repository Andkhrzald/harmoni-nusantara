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
                <div class="mb-4 p-4 rounded-lg bg-green-50 border border-green-200 text-green-700 text-sm flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">check_circle</span>
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="mb-4 p-4 rounded-lg bg-red-50 border border-red-200 text-red-700 text-sm flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">error</span>
                    {{ session('error') }}
                </div>
            @endif
            @if (session('info'))
                <div class="mb-4 p-4 rounded-lg bg-blue-50 border border-blue-200 text-blue-700 text-sm flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">info</span>
                    {{ session('info') }}
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <!-- Header Gradient -->
                <div class="bg-gradient-to-r from-primary-800 to-primary px-6 py-5">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <span class="w-12 h-12 rounded-xl bg-white/15 flex items-center justify-center">
                                <span class="material-symbols-outlined text-2xl text-white">forum</span>
                            </span>
                            <div>
                                <h2 class="text-lg font-bold text-white">{{ $room->name }}</h2>
                                <p class="text-sm text-white/70">{{ $room->description }}</p>
                            </div>
                        </div>
                        <div class="hidden sm:flex items-center gap-3 text-white/70 text-sm">
                            <span class="flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                                {{ $participants->count() }} online
                            </span>
                            <span class="text-white/30">|</span>
                            <span class="flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-sm">chat</span>
                                {{ $messages->count() }} pesan
                            </span>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col lg:flex-row">
                    <!-- Sidebar Peserta -->
                    <div class="w-full lg:w-64 border-b lg:border-b-0 lg:border-r border-gray-100 bg-surface-light shrink-0">
                        <div class="p-4">
                            <div class="flex items-center justify-between mb-3">
                                <h4 class="text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                    Peserta ({{ $participants->count() }})
                                </h4>
                                <button type="button" class="lg:hidden p-1 hover:bg-gray-200 rounded-lg transition-colors" onclick="document.getElementById('sidebar-toggle').classList.toggle('hidden')">
                                    <span class="material-symbols-outlined text-sm text-gray-400">close</span>
                                </button>
                            </div>
                            <div class="space-y-2">
                                @foreach ($participants as $p)
                                    <div class="flex items-center gap-3 p-2 rounded-xl hover:bg-white transition-colors group">
                                        <div class="relative shrink-0">
                                            @if ($p->user->avatar)
                                                <img src="{{ Storage::url($p->user->avatar) }}" alt="{{ $p->user->name }}"
                                                     class="w-9 h-9 rounded-full object-cover">
                                            @else
                                                <span class="w-9 h-9 rounded-full bg-primary/10 flex items-center justify-center text-xs font-semibold text-primary">
                                                    {{ strtoupper(substr($p->user->name, 0, 1)) }}
                                                </span>
                                            @endif
                                            <span class="absolute -bottom-0.5 -right-0.5 w-3 h-3 rounded-full border-2 border-white {{ $p->status === 'active' ? 'bg-green-500' : 'bg-gray-300' }}"></span>
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <p class="text-sm font-medium text-gray-700 truncate flex items-center gap-1.5">
                                                {{ $p->user->name }}
                                                @if ($p->role === 'creator')
                                                    <span class="text-[10px] bg-secondary/10 text-secondary px-1.5 py-0.5 rounded-full font-semibold">Admin</span>
                                                @elseif ($p->role === 'member')
                                                    <span class="text-[10px] bg-primary/10 text-primary px-1.5 py-0.5 rounded-full font-semibold">Member</span>
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
                                    <div class="mt-4 p-3 rounded-xl bg-yellow-50 border border-yellow-100">
                                        <div class="flex items-center gap-2">
                                            <span class="material-symbols-outlined text-sm text-yellow-600">hourglass_top</span>
                                            <p class="text-xs text-yellow-700">Permintaan bergabung sedang ditinjau admin.</p>
                                        </div>
                                    </div>
                                @elseif (!$participant)
                                    <form action="{{ route('forum.request-join') }}" method="POST" class="mt-4">
                                        @csrf
                                        <button type="submit" class="w-full text-sm bg-secondary text-white px-4 py-2.5 rounded-xl font-medium hover:bg-secondary-600 transition-colors flex items-center justify-center gap-2">
                                            <span class="material-symbols-outlined text-sm">person_add</span>
                                            Minta Bergabung
                                        </button>
                                    </form>
                                @endif
                                @if ($participant && $participant->role === 'creator' && $room->participants()->where('status', 'pending')->exists())
                                    <div class="mt-4 pt-4 border-t border-gray-100">
                                        <h5 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3 flex items-center gap-1.5">
                                            <span class="material-symbols-outlined text-sm">pending_actions</span>
                                            Pending
                                        </h5>
                                        @foreach ($room->participants()->with('user')->where('status', 'pending')->get() as $pending)
                                            <div class="flex items-center justify-between gap-2 py-1.5 px-2 rounded-lg hover:bg-white transition-colors">
                                                <div class="flex items-center gap-2 min-w-0">
                                                    @if ($pending->user->avatar)
                                                        <img src="{{ Storage::url($pending->user->avatar) }}" alt="" class="w-6 h-6 rounded-full object-cover shrink-0">
                                                    @else
                                                        <span class="w-6 h-6 rounded-full bg-gray-100 flex items-center justify-center text-xs font-medium text-gray-500 shrink-0">
                                                            {{ strtoupper(substr($pending->user->name, 0, 1)) }}
                                                        </span>
                                                    @endif
                                                    <span class="text-sm text-gray-600 truncate">{{ $pending->user->name }}</span>
                                                </div>
                                                <form action="{{ route('forum.approve', $pending->user) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="text-xs bg-green-500 text-white px-3 py-1.5 rounded-lg hover:bg-green-600 font-medium transition-colors flex items-center gap-1">
                                                        <span class="material-symbols-outlined text-xs">check</span>
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
                    <div class="flex-1 flex flex-col relative bg-surface">
                        @guest
                            <div class="absolute inset-0 z-10 flex items-center justify-center p-4">
                                <div class="w-full h-full backdrop-blur-sm bg-white/40 absolute rounded-br-2xl"></div>
                                <div class="relative z-20 bg-white p-8 rounded-2xl shadow-xl text-center max-w-sm mx-4 border border-gray-100">
                                    <span class="material-symbols-outlined text-6xl text-primary block mb-4">forum</span>
                                    <h2 class="text-xl font-bold text-gray-800">Gabung Komunitas</h2>
                                    <p class="text-gray-500 mt-2 text-sm">Mulai berdialog tentang agama, toleransi, dan kebersamaan bersama AI.</p>
                                    <div class="flex flex-col sm:flex-row gap-3 mt-6">
                                        <a href="{{ route('register') }}" class="bg-primary text-white px-6 py-3 rounded-xl font-semibold hover:bg-primary-600 transition-all shadow-lg shadow-primary/20 flex-1">
                                            Daftar Gratis
                                        </a>
                                        <a href="{{ route('login') }}" class="border-2 border-gray-200 text-gray-700 px-6 py-3 rounded-xl font-semibold hover:border-gray-300 transition-all flex-1">
                                            Masuk
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endguest

                        <!-- Messages -->
                        <div class="flex-1 overflow-y-auto p-4 sm:p-6 space-y-4 min-h-[400px] max-h-[600px] scrollbar-thin"
                             id="chat-messages"
                             style="{{ auth()->guest() ? 'filter: blur(12px); pointer-events: none; user-select: none;' : '' }}">
                            @forelse ($messages as $message)
                                @if ($message->is_ai)
                                    <div class="flex items-start gap-3 max-w-[85%] md:max-w-[70%]" id="message-{{ $message->id }}">
                                        <span class="w-8 h-8 rounded-full bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center text-xs font-bold text-white shrink-0 mt-0.5 shadow-sm">
                                            AI
                                        </span>
                                        <div>
                                            <div class="flex items-baseline gap-2 mb-1">
                                                <span class="text-xs font-semibold text-gray-500">AI Assistant</span>
                                                <span class="text-[10px] text-gray-400">{{ $message->created_at->diffForHumans() }}</span>
                                            </div>
                                            <div class="bg-white rounded-2xl rounded-tl-sm px-4 py-3 shadow-sm border border-gray-50">
                                                <p class="text-sm text-gray-700 leading-relaxed whitespace-pre-wrap">{{ $message->content }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="flex items-start gap-3 max-w-[85%] md:max-w-[70%] ml-auto flex-row-reverse" id="message-{{ $message->id }}">
                                        @if ($message->user->avatar)
                                            <img src="{{ Storage::url($message->user->avatar) }}" alt="{{ $message->user->name }}"
                                                 class="w-8 h-8 rounded-full object-cover shrink-0 mt-0.5">
                                        @else
                                            <span class="w-8 h-8 rounded-full bg-primary/15 flex items-center justify-center text-xs font-semibold text-primary shrink-0 mt-0.5">
                                                {{ strtoupper(substr($message->user->name, 0, 1)) }}
                                            </span>
                                        @endif
                                        <div class="items-end">
                                            <div class="flex items-baseline gap-2 mb-1 justify-end">
                                                <span class="text-[10px] text-gray-400">{{ $message->created_at->diffForHumans() }}</span>
                                                <span class="text-xs font-semibold text-gray-500">{{ $message->user->name }}</span>
                                            </div>
                                            <div class="bg-primary-100 rounded-2xl rounded-tr-sm px-4 py-3">
                                                <p class="text-sm text-gray-800 leading-relaxed whitespace-pre-wrap">{{ $message->content }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @empty
                                <div class="text-center py-16">
                                    <span class="material-symbols-outlined text-5xl text-gray-300 block mb-3">forum</span>
                                    <p class="text-gray-400 font-medium">Belum ada pesan.</p>
                                    <p class="text-gray-300 text-sm mt-1">Jadilah yang pertama memulai dialog!</p>
                                </div>
                            @endforelse
                        </div>

                        <!-- Input Area -->
                        @auth
                            @if ($canPost)
                                <div class="border-t border-gray-100 bg-white px-4 sm:px-6 py-4">
                                    <form action="{{ route('forum.message') }}" method="POST" class="flex gap-3 items-center">
                                        @csrf
                                        <div class="flex-1 relative">
                                            <input type="text"
                                                   name="content"
                                                   required
                                                   maxlength="2000"
                                                   placeholder="Ketik pesan... Gunakan @ai untuk bertanya kepada AI"
                                                   class="w-full rounded-full border-gray-200 bg-surface px-5 py-3 focus:border-primary focus:ring-primary text-sm pr-12"
                                                   autocomplete="off">
                                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-[10px] text-gray-300 font-mono">@ai</span>
                                        </div>
                                        <button type="submit"
                                                class="bg-primary text-white w-11 h-11 rounded-full hover:bg-primary-600 transition-colors flex items-center justify-center shrink-0 shadow-sm hover:shadow-md">
                                            <span class="material-symbols-outlined text-sm">send</span>
                                        </button>
                                    </form>
                                </div>
                            @else
                                <div class="border-t border-gray-100 bg-white px-4 sm:px-6 py-4 relative">
                                    <div class="absolute inset-0 backdrop-blur-sm bg-white/50 z-10 flex items-center justify-center rounded-br-2xl">
                                        <div class="text-center">
                                            <p class="text-sm text-gray-500 mb-2">Kamu perlu bergabung sebagai anggota untuk menulis pesan.</p>
                                            <form action="{{ route('forum.request-join') }}" method="POST">
                                                @csrf
                                                <button type="submit" class="text-sm bg-secondary text-white px-5 py-2.5 rounded-xl font-medium hover:bg-secondary-600 transition-colors inline-flex items-center gap-2">
                                                    <span class="material-symbols-outlined text-sm">person_add</span>
                                                    Minta Bergabung
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="flex gap-3 items-center opacity-40">
                                        <div class="flex-1">
                                            <div class="w-full rounded-full border border-gray-200 bg-gray-50 px-5 py-3 text-sm text-gray-400">Tulis pesan...</div>
                                        </div>
                                        <div class="bg-gray-200 w-11 h-11 rounded-full flex items-center justify-center">
                                            <span class="material-symbols-outlined text-sm text-gray-400">send</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="border-t border-gray-100 bg-white px-4 sm:px-6 py-4">
                                <div class="flex gap-3 items-center opacity-40">
                                    <div class="flex-1">
                                        <div class="w-full rounded-full border border-gray-200 bg-gray-50 px-5 py-3 text-sm text-gray-400">Masuk untuk bergabung dalam diskusi...</div>
                                    </div>
                                    <div class="bg-gray-200 w-11 h-11 rounded-full flex items-center justify-center">
                                        <span class="material-symbols-outlined text-sm text-gray-400">send</span>
                                    </div>
                                </div>
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
