<header class="h-14 flex items-center justify-between px-4 border-b border-border bg-card">

    <span class="font-semibold text-base">
        DC Ops
    </span>

    <div class="relative">
        <button id="opsMenuBtn" class="p-2 rounded-lg hover:bg-bg">
            <i data-lucide="user" class="w-5 h-5"></i>
        </button>

        <div id="opsMenu" class="hidden absolute right-0 mt-2 w-40 bg-card border border-border rounded-lg shadow-lg">
            <div class="px-4 py-2 text-sm text-text-secondary">
                {{ auth()->user()->name }}
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full text-left px-4 py-2 text-sm hover:bg-bg">
                    Logout
                </button>
            </form>
        </div>
    </div>
</header>

<script>
    const btn = document.getElementById('opsMenuBtn');
    const menu = document.getElementById('opsMenu');

    btn.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });

    document.addEventListener('click', (e) => {
        if (!btn.contains(e.target)) {
            menu.classList.add('hidden');
        }
    });
</script>
