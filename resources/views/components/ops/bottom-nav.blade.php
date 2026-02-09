<nav class="fixed bottom-0 inset-x-0 h-16 bg-card border-t border-border
            flex justify-around items-center">

    <a href="{{ route('dashboard') }}"
        class="flex flex-col items-center text-xs
       {{ request()->routeIs('dashboard') ? 'text-primary' : 'text-text-secondary' }}">
        <i data-lucide="home" class="w-5 h-5"></i>
        Dashboard
    </a>

    <a href="{{ route('my.checklists') }}"
        class="flex flex-col items-center text-xs
       {{ request()->routeIs('my.checklists*') ? 'text-primary' : 'text-text-secondary' }}">
        <i data-lucide="clipboard-check" class="w-5 h-5"></i>
        Checklist
    </a>

</nav>
