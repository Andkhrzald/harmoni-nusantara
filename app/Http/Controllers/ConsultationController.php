<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\ConsultationMessage;
use App\Services\EncryptionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ConsultationController extends Controller
{
    public function index(): View
    {
        $consultations = Consultation::where('user_id', auth()->id())
            ->with('expert')
            ->latest()
            ->paginate(10);

        return view('consultations.index', compact('consultations'));
    }

    public function create(): View
    {
        return view('consultations.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => ['required', 'string', 'max:500'],
        ]);

        $consultation = Consultation::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'status' => 'open',
            'is_private' => true,
        ]);

        return redirect()->route('aksi.konsultasi.show', $consultation->id)
            ->with('success', 'Konsultasi berhasil dibuat! Tunggu response dari penyuluh.');
    }

    public function show(int $id): View
    {
        $consultation = Consultation::where('id', $id)
            ->where(function ($query) {
                $query->where('user_id', auth()->id())
                    ->orWhere('expert_id', auth()->id());
            })
            ->with('user', 'expert', 'messages.sender')
            ->firstOrFail();

        $encryptionService = new EncryptionService;
        $messages = $consultation->messages->map(function ($message) use ($encryptionService) {
            $message->message = $encryptionService->decryptMessage($message->message_encrypted);

            return $message;
        });

        return view('consultations.show', compact('consultation', 'messages'));
    }

    public function sendMessage(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'message' => ['required', 'string', 'max:5000'],
        ]);

        $consultation = Consultation::where('id', $id)
            ->where(function ($query) {
                $query->where('user_id', auth()->id())
                    ->orWhere('expert_id', auth()->id());
            })
            ->firstOrFail();

        $encryptionService = new EncryptionService;
        $encryptedMessage = $encryptionService->encryptMessage($request->message);

        ConsultationMessage::create([
            'consultation_id' => $consultation->id,
            'sender_id' => auth()->id(),
            'message_encrypted' => $encryptedMessage,
        ]);

        if ($consultation->status === 'open') {
            $consultation->update(['status' => 'in_progress']);
        }

        return back()->with('success', 'Pesan terkirim!');
    }

    public function assignExpert(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'expert_id' => ['required', 'exists:users,id'],
        ]);

        $consultation = Consultation::findOrFail($id);
        $consultation->update([
            'expert_id' => $request->expert_id,
            'status' => 'in_progress',
        ]);

        return back()->with('success', 'Penyuluh berhasil ditugaskan!');
    }

    public function close(int $id): RedirectResponse
    {
        $consultation = Consultation::findOrFail($id);
        $consultation->update(['status' => 'closed']);

        return back()->with('success', 'Konsultasi ditutup!');
    }
}
