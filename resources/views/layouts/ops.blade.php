<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>DC Ops</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="bg-bg text-text-primary antialiased">

    <div class="min-h-screen flex flex-col">

        {{-- Content --}}
        <main class="flex-1 p-4 pb-24">
            @yield('content')
        </main>


    </div>

    <script>
        lucide.createIcons();
    </script>

</body>

</html>
