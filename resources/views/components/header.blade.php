<header class="h-16 flex items-center justify-between px-6
               bg-card border-b border-border rounded-2xl">

    <!-- Left : Page Title -->
    <div class="flex items-center gap-2">
        <i data-lucide="chevron-right" class="w-4 h-4 text-text-muted"></i>
        <h1 class="text-sm font-medium text-text-secondary">
            {{ $title ?? 'Dashboard' }}
        </h1>
    </div>

    <!-- Right : Profile -->
    <div class="relative">
        <button id="profileButton" class="flex items-center gap-3 focus:outline-none">

            <div
                class="h-8 w-8 rounded-full bg-primary-soft
                        flex items-center justify-center text-bg">
                <i data-lucide="user" class="w-4 h-4"></i>
            </div>

            <div class="text-left hidden sm:block">
                <p class="text-sm font-medium text-text-primary">
                    {{ auth()->user()->name }}
                </p>
                <p class="text-xs text-text-muted capitalize">
                    {{ auth()->user()->role }}
                </p>
            </div>

            <i data-lucide="chevron-down" class="w-4 h-4 text-text-muted"></i>
        </button>

        <!-- Dropdown -->
        <div id="profileDropdown"
            class="hidden absolute right-0 mt-3 w-40
                    bg-card border border-border rounded-lg shadow-lg z-50">

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full flex items-center gap-2 px-4 py-2
                               text-sm text-text-secondary
                               hover:bg-bg hover:text-text-primary transition">
                    <i data-lucide="log-out" class="w-4 h-4"></i>
                    Logout
                </button>
            </form>
        </div>
    </div>
</header>
