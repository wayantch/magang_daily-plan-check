@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl font-semibold text-text-primary">User Management</h1>
            <p class="text-sm text-text-muted">
                Manage admin and operations users
            </p>
        </div>

        <!-- Add User -->
        <a href="{{ route('users.create') }}"
           class="inline-flex items-center gap-2 px-4 py-2 rounded-lg
                  bg-primary text-accent-foreground font-medium
                  hover:bg-primary-hover transition">
            <i data-lucide="user-plus" class="w-4 h-4"></i>
            Add User
        </a>
    </div>

    <x-alert />

    <!-- Table Card -->
    <div class="bg-card border border-border rounded-xl overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-bg border-b border-border">
                <tr class="text-text-secondary">
                    <th class="px-4 py-3 text-left">Name</th>
                    <th class="px-4 py-3 text-left">Email</th>
                    <th class="px-4 py-3 text-left">Role</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-right">Action</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-border">
                @foreach ($users as $user)
                <tr class="hover:bg-bg transition">
                    <td class="px-4 py-3 font-medium text-text-primary">
                        {{ $user->name }}
                    </td>
                    <td class="px-4 py-3 text-text-secondary">
                        {{ $user->email }}
                    </td>
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 text-xs rounded-md
                            {{ $user->role === 'admin'
                                ? 'bg-primary-soft text-bg'
                                : 'bg-zinc-800 text-zinc-200' }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td class="px-4 py-3">
                        <span class="inline-flex items-center gap-1 text-xs
                            {{ $user->is_active
                                ? 'text-success'
                                : 'text-danger' }}">
                            <i data-lucide="{{ $user->is_active ? 'check-circle' : 'x-circle' }}" class="w-4 h-4"></i>
                            {{ $user->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-right">
                        <div class="inline-flex items-center gap-2">
                            <!-- Edit -->
                            <a href="{{ route('users.edit', $user->id) }}"
                               class="p-2 rounded-lg
                                      text-text-secondary
                                      hover:bg-primary-soft
                                      hover:text-bg transition">
                                <i data-lucide="edit" class="w-4 h-4"></i>
                            </a>

                            <!-- Delete -->
                            <form action="{{ route('users.destroy', $user->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Delete this user?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="p-2 rounded-lg
                                               text-text-secondary
                                               hover:bg-danger
                                               hover:text-white transition">
                                    <i data-lucide="trash" class="w-4 h-4"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
