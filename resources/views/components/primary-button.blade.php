{{-- resources/views/components/primary-button.blade.php --}}
@props(['type' => 'submit'])

<button {{ $attributes->merge(['type' => $type, 'class' => 'inline-flex items-center px-4 py-2 bg-trade-green border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-trade-green-dark focus:bg-trade-green-dark active:bg-trade-green-dark focus:outline-none focus:ring-2 focus:ring-trade-amber focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>