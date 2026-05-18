@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-0 focus:border-primary focus:ring-0 rounded-xl shadow-sm bg-transparent']) }}>
