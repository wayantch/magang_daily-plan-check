<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'DC Monitoring') }}</title>

    {{-- Tailwind --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Lucide Icons --}}
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="bg-bg text-text-primary antialiased">

<div class="flex min-h-screen bg-bg text-text-primary">

    {{-- Sidebar --}}
    @include('components.sidebar')

    {{-- Main --}}
    <main class="ml-64 flex-1 h-screen overflow-y-auto p-6">
        @yield('content')
    </main>

</div>


{{-- Profile Dropdown Script --}}
<script>
    const btn = document.getElementById('profileButton');
    const dropdown = document.getElementById('profileDropdown');

    btn?.addEventListener('click', (e) => {
        e.stopPropagation();
        dropdown.classList.toggle('hidden');
    });

    document.addEventListener('click', (e) => {
        if (!dropdown?.contains(e.target)) {
            dropdown?.classList.add('hidden');
        }
    });
</script>

{{-- Lucide Init --}}
<script>
    lucide.createIcons();
</script>

</body>
</html>
