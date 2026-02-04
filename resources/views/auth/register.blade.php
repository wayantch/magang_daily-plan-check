<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register | DC Monitoring</title>
    @vite(['resources/css/app.css'])
</head>

<body class="min-h-screen flex items-center justify-center bg-bg text-text-primary">

<div class="w-full max-w-md bg-card border border-border rounded-xl p-8">
    <h1 class="text-xl font-semibold mb-6">Create Account</h1>

    <form method="POST" action="{{ route('register.store') }}" class="space-y-4">
        @csrf

        <input type="text" name="name" placeholder="Name" required
               class="w-full px-4 py-2 rounded-lg bg-bg border border-border">

        <input type="email" name="email" placeholder="Email" required
               class="w-full px-4 py-2 rounded-lg bg-bg border border-border">

        <input type="password" name="password" placeholder="Password" required
               class="w-full px-4 py-2 rounded-lg bg-bg border border-border">

        <input type="password" name="password_confirmation" placeholder="Confirm Password" required
               class="w-full px-4 py-2 rounded-lg bg-bg border border-border">

        <button class="w-full py-2 rounded-lg bg-primary text-accent-foreground">
            Register
        </button>
    </form>
</div>

</body>
</html>
