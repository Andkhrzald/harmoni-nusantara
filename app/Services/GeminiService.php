<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiService
{
    protected string $apiKey;

    protected string $endpoint = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent';

    protected string $systemPrompt = 'Kamu adalah asisten AI untuk platform Harmoni Nusantara, sebuah komunitas digital yang mempromosikan toleransi dan kerukunan antar umat beragama di Indonesia.

Aturan:
1. Jawab pertanyaan tentang sejarah agama, panduan ibadah, etika beragama, dan toleransi dengan akurat dan santun.
2. Gunakan bahasa Indonesia yang baik dan ramah.
3. Jika ditanya di luar konteks keagamaan yang toleran, arahkan kembali ke topik Harmoni Nusantara.
4. Jangan pernah memberikan jawaban yang mengandung ujaran kebencian, SARA negatif, atau provokasi.
5. Akui jika kamu tidak tahu jawabannya, jangan mengada-ada.
6. Berikan perspektif yang seimbang ketika membahas perbedaan antar agama.
7. Kutip sumber jika memungkinkan (Al-Quran, Kitab Suci, referensi sejarah).';

    public function __construct()
    {
        $this->apiKey = config('services.gemini.api_key');
    }

    public function ask(string $prompt, array $history = []): string
    {
        if (empty($this->apiKey)) {
            return 'Maaf, layanan AI sedang tidak tersedia. Silakan coba lagi nanti.';
        }

        $contents = [];

        $contents[] = [
            'role' => 'user',
            'parts' => [['text' => $this->systemPrompt]],
        ];

        $contents[] = [
            'role' => 'model',
            'parts' => [['text' => 'Saya mengerti. Saya akan menjawab sebagai asisten Harmoni Nusantara sesuai panduan tersebut.']],
        ];

        foreach ($history as $entry) {
            $contents[] = [
                'role' => $entry['role'],
                'parts' => [['text' => $entry['text']]],
            ];
        }

        $contents[] = [
            'role' => 'user',
            'parts' => [['text' => $prompt]],
        ];

        try {
            $response = Http::timeout(30)
                ->post("{$this->endpoint}?key={$this->apiKey}", [
                    'contents' => $contents,
                    'safetySettings' => [
                        ['category' => 'HARM_CATEGORY_HARASSMENT', 'threshold' => 'BLOCK_ONLY_HIGH'],
                        ['category' => 'HARM_CATEGORY_HATE_SPEECH', 'threshold' => 'BLOCK_ONLY_HIGH'],
                        ['category' => 'HARM_CATEGORY_SEXUALLY_EXPLICIT', 'threshold' => 'BLOCK_ONLY_HIGH'],
                        ['category' => 'HARM_CATEGORY_DANGEROUS_CONTENT', 'threshold' => 'BLOCK_ONLY_HIGH'],
                    ],
                    'generationConfig' => [
                        'temperature' => 0.7,
                        'maxOutputTokens' => 1024,
                    ],
                ]);

            if ($response->successful()) {
                $data = $response->json();

                return $data['candidates'][0]['content']['parts'][0]['text']
                    ?? 'Maaf, AI tidak dapat memberikan jawaban saat ini.';
            }

            Log::error('Gemini API error', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return 'Maaf, terjadi kesalahan saat menghubungi AI. Silakan coba lagi.';
        } catch (\Exception $e) {
            Log::error('Gemini API exception', [
                'message' => $e->getMessage(),
            ]);

            return 'Maaf, layanan AI sedang sibuk. Silakan coba lagi nanti.';
        }
    }
}
