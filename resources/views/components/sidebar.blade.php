@php
    $menuMonitoring = [
        [
            'label' => 'Area',
            'route' => 'areas.index',
            'icon' => 'map-pin',
        ],
        [
            'label' => 'Room',
            'route' => 'rooms.index',
            'icon' => 'door-open',
        ],
        [
            'label' => 'Equipment',
            'route' => 'equipments.index',
            'icon' => 'server',
        ],
        [
            'label' => 'Checklist Template',
            'route' => 'checklist-templates.index',
            'icon' => 'clipboard-list',
        ],
        // [
        //     'label' => 'Form',
        //     'route' => 'checklists.index',
        //     'icon' => 'clipboard-check',
        // ],
    ];
@endphp

<aside
    class="fixed inset-y-0 left-0 w-64
           bg-card border-r border-border
           flex flex-col z-40">


    <!-- Logo -->
    <div class="h-16 flex items-center px-6 border-b border-border">
        <span class="text-lg font-semibold text-text-primary tracking-wide">
            DC Monitoring
        </span>
    </div>

    <!-- Menu -->
    <nav class="flex-1 px-2 py-6 space-y-6 overflow-y-auto">

        {{-- Dashboard --}}
        <a href="{{ route('dashboard') }}"
            class="flex items-center gap-3 px-4 py-2.5 rounded-lg font-medium transition
           {{ request()->routeIs('dashboard')
               ? 'bg-primary text-accent-foreground shadow-sm'
               : 'text-text-secondary hover:bg-primary-soft hover:text-bg' }}">
            <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
            <span>Dashboard</span>
        </a>

        {{-- Manage --}}
        <div class="space-y-2">
            <p class="px-4 text-xs uppercase tracking-wider text-text-muted">
                Manage
            </p>

            {{-- User --}}
            <a href="{{ route('users.index') }}"
                class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition
       {{ request()->routeIs('users.*')
           ? 'bg-primary-soft text-bg'
           : 'text-text-secondary hover:bg-primary-soft hover:text-bg' }}">
                <i data-lucide="users" class="w-5 h-5"></i>
                <span>User</span>
            </a>

            {{-- Type --}}
            <a href="{{ route('types.index') }}"
                class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition
       {{ request()->routeIs('types.*')
           ? 'bg-primary-soft text-bg'
           : 'text-text-secondary hover:bg-primary-soft hover:text-bg' }}">
                <i data-lucide="layers" class="w-5 h-5"></i>
                <span>Type</span>
            </a>

            {{-- Category --}}
            <a href="{{ route('categories.index') }}"
                class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition
       {{ request()->routeIs('categories.*')
           ? 'bg-primary-soft text-bg'
           : 'text-text-secondary hover:bg-primary-soft hover:text-bg' }}">
                <i data-lucide="tags" class="w-5 h-5"></i>
                <span>Category</span>
            </a>

        </div>


        {{-- Monitoring --}}
        <div class="space-y-2">
            <p class="px-4 text-xs uppercase tracking-wider text-text-muted">
                Monitoring
            </p>

            @foreach ($menuMonitoring as $menu)
                <a href="{{ route($menu['route']) }}"
                    class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition
                   {{ request()->routeIs(Str::before($menu['route'], '.') . '.*')
                       ? 'bg-primary-soft text-bg'
                       : 'text-text-secondary hover:bg-primary-soft hover:text-bg' }}">
                    <i data-lucide="{{ $menu['icon'] }}" class="w-5 h-5"></i>
                    <span>{{ $menu['label'] }}</span>
                </a>
            @endforeach
        </div>

    </nav>
</aside>
