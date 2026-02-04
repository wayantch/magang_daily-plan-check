<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | DC Monitoring</title>
    @vite(['resources/css/app.css'])
</head>

<body class="min-h-screen flex items-center justify-center bg-bg text-text-primary">

<div class="w-full max-w-md bg-card border border-border rounded-xl p-8">
    <h1 class="text-xl font-semibold mb-2">Sign In</h1>
    <p class="text-sm text-text-muted mb-6">
        Login to continue monitoring
    </p>

    <form method="POST" action="{{ route('login.process') }}" class="space-y-4">
        @csrf

        <div>
            <label class="text-sm text-text-secondary">Email</label>
            <input type="email" name="email" required
                   class="w-full mt-1 px-4 py-2 rounded-lg bg-bg border border-border
                          focus:outline-none focus:ring-2 focus:ring-primary">
        </div>

        <div>
            <label class="text-sm text-text-secondary">Password</label>
            <input type="password" name="password" required
                   class="w-full mt-1 px-4 py-2 rounded-lg bg-bg border border-border
                          focus:outline-none focus:ring-2 focus:ring-primary">
        </div>

        <button type="submit"
                class="w-full py-2 rounded-lg bg-primary text-accent-foreground
                       font-medium hover:bg-primary-hover transition">
            Login
        </button>
        <x-alert />
    </form>
</div>

</body>
</html>
