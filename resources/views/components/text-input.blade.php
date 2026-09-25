{{-- resources/views/components/text-input.blade.php --}}
@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-trade-green focus:ring-trade-green rounded-md shadow-sm']) }}>