@props([
    'user' => null,
    'link' => null,
    'isMostVisited' => false,
])

@php
    $isUserProfileOwner = auth()->user()?->is($user);
    $linkWithRef = $link->url.(str_contains($link->url, '?') ? '&' : '?').'ref=pinkary';
@endphp

<a
    href="{{ $linkWithRef }}"
    target="_blank"
    rel="me noopener"
    class="relative w-full items-center justify-center px-4 font-bold text-white transition duration-300 ease-in-out"
    onclick="e.preventDefault(); window.open('{{ $linkWithRef }}', '_blank')"
>
    <div class="flex h-full items-center justify-center">
        <p class="truncate">{{ $link->description }}</p>
    </div>

    @if ($isUserProfileOwner)
        <span
            class="absolute top-1/2 right-12 -translate-y-1/2 cursor-help text-xs text-white"
            title="Clicked {{ Number::format($link->click_count) }} times"
        >
            {{ Number::abbreviate($link->click_count) }} {{ str('click')->plural($link->click_count) }}
        </span>
    @elseif ($isMostVisited)
        <span
            data-most-visited-link-id="{{ $link->id }}"
            class="pointer-events-none absolute top-1/2 right-3 z-10 -translate-y-1/2 whitespace-nowrap rounded-md border border-white/30 bg-slate-950/35 px-2.5 py-1 text-xs font-semibold text-white shadow-sm backdrop-blur-md"
        >
            Most Visited
        </span>
    @endif
</a>
