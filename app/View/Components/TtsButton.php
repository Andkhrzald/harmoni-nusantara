<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TtsButton extends Component
{
    public function __construct(
        public string $target = '.content-text',
        public string $label = 'Baca'
    ) {}

    public function render()
    {
        return <<<'HTML'
        <button
            x-data="{ speaking: false, speak() { 
                const text = document.querySelector(this.$el.dataset.target)?.textContent;
                if (!text) return;
                
                if (this.speaking) {
                    window.speechSynthesis.cancel();
                    this.speaking = false;
                    return;
                }
                
                const utterance = new SpeechSynthesisUtterance(text);
                utterance.lang = 'id-ID';
                utterance.rate = 0.9;
                
                utterance.onstart = () => this.speaking = true;
                utterance.onend = () => this.speaking = false;
                utterance.onerror = () => this.speaking = false;
                
                window.speechSynthesis.speak(utterance);
            }}"
            x-on:click="speak()"
            data-target="{{ $target }}"
            class="inline-flex items-center gap-1 px-3 py-1.5 text-sm bg-indigo-100 text-indigo-700 rounded-full hover:bg-indigo-200 transition-colors"
            :class="{ 'bg-red-100 text-red-700': speaking }"
        >
            <svg x-show="!speaking" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"/>
            </svg>
            <svg x-show="speaking" x-cloak class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 10a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z"/>
            </svg>
            <span x-text="speaking ? 'Berhenti' : '{{ $label }}'"></span>
        </button>
        HTML;
    }
}
