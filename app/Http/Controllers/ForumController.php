<?php

namespace App\Http\Controllers;

use App\Models\ForumMessage;
use App\Models\ForumParticipant;
use App\Models\ForumRoom;
use App\Models\User;
use App\Services\GeminiService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ForumController extends Controller
{
    public function index(): View
    {
        $room = ForumRoom::with([
            'messages' => function ($q) {
                $q->latest()->limit(100);
            },
            'messages.user',
            'participants.user',
        ])->first();

        if (! $room) {
            $room = ForumRoom::create([
                'name' => 'Ruang Bersama Harmoni Nusantara',
                'description' => 'Tempat berdialog tentang agama, toleransi, dan kebersamaan.',
                'user_id' => 1,
                'is_active' => true,
            ]);
        }

        $user = auth()->user();
        $participant = null;
        $canPost = false;

        if ($user) {
            $participant = ForumParticipant::where('forum_room_id', $room->id)
                ->where('user_id', $user->id)
                ->first();

            $canPost = $participant
                && $participant->status === 'active'
                && in_array($participant->role, ['creator', 'member']);
        }

        $messages = $room->messages()->orderBy('created_at')->get();
        $participants = $room->participants()->with('user')->where('status', 'active')->get();

        return view('forum.index', compact('room', 'messages', 'participants', 'participant', 'canPost'));
    }

    public function storeMessage(Request $request, GeminiService $gemini): RedirectResponse
    {
        $request->validate([
            'content' => 'required|string|max:2000',
        ]);

        $room = ForumRoom::firstOrFail();
        $user = $request->user();

        $participant = ForumParticipant::where('forum_room_id', $room->id)
            ->where('user_id', $user->id)
            ->where('status', 'active')
            ->whereIn('role', ['creator', 'member'])
            ->first();

        if (! $participant) {
            return back()->with('error', 'Kamu belum memiliki izin untuk menulis pesan.');
        }

        $message = ForumMessage::create([
            'forum_room_id' => $room->id,
            'user_id' => $user->id,
            'content' => $request->content,
            'is_ai' => false,
            'created_at' => now(),
        ]);

        if (str_contains($request->content, '@ai')) {
            $history = ForumMessage::where('forum_room_id', $room->id)
                ->where(function ($q) use ($user) {
                    $q->where('user_id', $user->id)->orWhere('is_ai', true);
                })
                ->latest()
                ->limit(10)
                ->get()
                ->reverse()
                ->map(fn ($m) => [
                    'role' => $m->is_ai ? 'model' : 'user',
                    'text' => $m->content,
                ])
                ->values()
                ->toArray();

            $prompt = str_replace('@ai', '', $request->content);
            $aiResponse = $gemini->ask(trim($prompt), $history);

            ForumMessage::create([
                'forum_room_id' => $room->id,
                'user_id' => null,
                'content' => $aiResponse,
                'is_ai' => true,
                'created_at' => now()->addSecond(),
            ]);
        }

        return redirect()->route('forum');
    }

    public function requestJoin(Request $request): RedirectResponse
    {
        $room = ForumRoom::firstOrFail();
        $user = $request->user();

        $existing = ForumParticipant::where('forum_room_id', $room->id)
            ->where('user_id', $user->id)
            ->first();

        if ($existing) {
            return back()->with('info', 'Permintaan sudah dikirim sebelumnya.');
        }

        ForumParticipant::create([
            'forum_room_id' => $room->id,
            'user_id' => $user->id,
            'role' => 'viewer',
            'status' => 'pending',
        ]);

        return back()->with('success', 'Permintaan bergabung telah dikirim ke admin.');
    }

    public function approveMember(Request $request, User $user): RedirectResponse
    {
        $room = ForumRoom::firstOrFail();

        $creator = ForumParticipant::where('forum_room_id', $room->id)
            ->where('user_id', $request->user()->id)
            ->where('role', 'creator')
            ->first();

        if (! $creator) {
            return back()->with('error', 'Hanya creator ruangan yang bisa menyetujui anggota.');
        }

        $participant = ForumParticipant::where('forum_room_id', $room->id)
            ->where('user_id', $user->id)
            ->first();

        if (! $participant || $participant->status !== 'pending') {
            return back()->with('error', 'Anggota tidak ditemukan atau sudah disetujui.');
        }

        $participant->update([
            'status' => 'active',
            'role' => 'member',
        ]);

        return back()->with('success', 'Anggota berhasil disetujui.');
    }
}
