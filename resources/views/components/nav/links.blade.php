<x-nav.link label='Home' href="{{ route('welcome') }}">
    <i class="bi bi-house"></i>
</x-nav.link>

@can('admin')
    <x-nav.link label='Users' href="{{ route('users.index') }}">
        <i class="bi bi-people"></i>
    </x-nav.link>
    <x-nav.link label='Create User' href="{{ route('users.create') }}">
        <i class="bi bi-person-add"></i>
    </x-nav.link>
@endcan

@can('employee')
    <x-nav.link label='Categories' href="{{ route('categories.index') }}">
        <i class="bi bi-tags"></i>
    </x-nav.link>
    <x-nav.link label='Create Category' href="{{ route('categories.create') }}">
        <i class="bi bi-tag-fill"></i>
    </x-nav.link>
    <x-nav.link label='Products' href="{{ route('products.index') }}">
        <i class="bi bi-box-seam"></i>
    </x-nav.link>
    <x-nav.link label='Add Product' href="{{ route('products.create') }}">
        <i class="bi bi-plus-square"></i>
    </x-nav.link>
    <x-nav.link label='Stock' href="{{ route('stock.index') }}">
        <i class="bi bi-archive"></i>
    </x-nav.link>
    <x-nav.link label='My Sales' href="{{ route('sales.index') }}">
        <i class="bi bi-receipt-cutoff"></i>
    </x-nav.link>
@endcan


@can('analyst')
    <x-nav.link label='users' href="{{ route('stats.users') }}">
        <i class="bi bi-diagram-3-fill"></i>
    </x-nav.link>
    <x-nav.link label='categories' href="{{ route('stats.categories') }}">
        <i class="bi bi-file-bar-graph-fill"></i>
    </x-nav.link>
    <x-nav.link label='products' href="{{ route('stats.products') }}">
        <i class="bi bi-box"></i>
    </x-nav.link>
    <x-nav.link label='money' href="{{ route('stats.money') }}">
        <i class="bi bi-graph-up-arrow"></i>
    </x-nav.link>
    <x-nav.link label='stock' href="{{ route('stats.stock') }}">
        <i class="bi bi-pie-chart-fill"></i>
    </x-nav.link>
    <x-nav.link label='expiry' href="{{ route('stats.expiry') }}">
        <i class="bi bi-calendar-week"></i>
    </x-nav.link>
    <x-nav.link label='reports' href="{{ route('stats.reports') }}">
        <i class="bi bi-clipboard-data"></i>
    </x-nav.link>
@endcan
