{{--
    resources/views/components/application-logo.blade.php

    Replaces Breeze's default Laravel logo. Usage is unchanged from Breeze:
        <x-application-logo class="h-9 w-auto" />
    Pass any sizing classes via $attributes — color is fixed to the brand
    palette since this is a two-color mark, not a single-tone icon.
--}}
<svg {{ $attributes->merge(['class' => 'h-9 w-auto']) }} viewBox="0 0 120 120" xmlns="http://www.w3.org/2000/svg" role="img">
    <title>TradeConnect</title>
    <g transform="translate(60,60)">
        <circle cx="-17" cy="0" r="28" fill="#1f5f4f" />
        <circle cx="17" cy="0" r="28" fill="#e8a33d" />
        <circle cx="0" cy="0" r="8.5" fill="#ffffff" />
    </g>
</svg>