@props(['label' => ''])

<li class="nav-item">
    <a {{ $attributes->merge(['class' => 'nav-link d-flex align-items-center rounded p-2 text-dark fw-bold mb-2']) }}>
        {{ $slot }}
        <span>{{ $label }}</span>
    </a>
</li>
