@extends('layouts.app')

@section('content')
    <div class="space-y-6">

        <x-header title="Create User" />
        <x-alert />

        <form method="POST" action="{{ route('users.store') }}" class="bg-card border border-border rounded-xl p-6 space-y-4">
            @csrf

            {{-- Name --}}
            <div>
                <label class="text-sm text-text-secondary">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    class="w-full mt-1 px-4 py-2 rounded-lg
                          bg-bg border border-border
                          focus:outline-none focus:ring-2 focus:ring-primary">
            </div>

            {{-- Email --}}
            <div>
                <label class="text-sm text-text-secondary">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full mt-1 px-4 py-2 rounded-lg
                          bg-bg border border-border
                          focus:outline-none focus:ring-2 focus:ring-primary">
            </div>

            {{-- Password --}}
            <div>
                <label class="text-sm text-text-secondary">Password</label>
                <input type="password" name="password" required
                    class="w-full mt-1 px-4 py-2 rounded-lg
                          bg-bg border border-border
                          focus:outline-none focus:ring-2 focus:ring-primary">
            </div>

            {{-- Role --}}
            <div>
                <label class="text-sm text-text-secondary">Role</label>
                <select name="role" required
                    class="w-full mt-1 px-4 py-2 rounded-lg
                           bg-bg border border-border
                           focus:outline-none focus:ring-2 focus:ring-primary">
                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>
                        Admin
                    </option>
                    <option value="ops" {{ old('role', 'ops') === 'ops' ? 'selected' : '' }}>
                        Operations
                    </option>
                </select>
            </div>

            {{-- Status --}}
            <div>
                <label class="text-sm text-text-secondary">Status</label>
                <select name="is_active" required
                    class="w-full mt-1 px-4 py-2 rounded-lg
                           bg-bg border border-border
                           focus:outline-none focus:ring-2 focus:ring-primary">
                    <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>
                        Inactive
                    </option>
                    <option value="1" {{ old('is_active', 1) == 1 ? 'selected' : '' }}>
                        Active
                    </option>
                </select>
            </div>

            {{-- Action --}}
            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ route('users.index') }}" class="px-4 py-2 border border-border rounded-lg text-text-secondary">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-2 rounded-lg bg-primary text-accent-foreground">
                    Save
                </button>
            </div>
        </form>

    </div>
@endsection
