@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <x-header title="My Checklist" />

    <!-- Info + Action -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-lg font-semibold text-text-primary">
                My Daily Plan Check
            </h2>
            <p class="text-sm text-text-muted">
                Your submitted checklist history
            </p>
        </div>

        <a href="{{ route('my.checklist.create') }}"
           class="inline-flex items-center gap-2 px-4 py-2 rounded-lg
                  bg-primary text-accent-foreground font-medium
                  hover:bg-primary-hover transition">
            <i data-lucide="plus-circle" class="w-4 h-4"></i>
            New Checklist
        </a>
    </div>

    <!-- Table -->
    <div class="bg-card border border-border rounded-xl overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-bg border-b border-border">
                <tr class="text-text-secondary">
                    <th class="px-4 py-3 text-left">Date</th>
                    <th class="px-4 py-3 text-left">Area</th>
                    <th class="px-4 py-3 text-left">Room</th>
                    <th class="px-4 py-3 text-left">Status</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-border">
                @forelse ($checklists as $checklist)
                <tr class="hover:bg-bg transition">
                    <td class="px-4 py-3 font-medium">
                        {{ \Carbon\Carbon::parse($checklist->check_date)->format('d M Y') }}
                    </td>

                    <td class="px-4 py-3 text-text-secondary">
                        {{ $checklist->area->name }}
                    </td>

                    <td class="px-4 py-3 text-text-secondary">
                        {{ $checklist->room?->name ?? '-' }}
                    </td>

                    <td class="px-4 py-3">
                        <span class="px-2 py-1 text-xs rounded-md
                            {{ $checklist->status === 'submitted'
                                ? 'bg-primary-soft text-bg'
                                : 'bg-zinc-800 text-zinc-200' }}">
                            {{ ucfirst($checklist->status) }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4"
                        class="px-4 py-6 text-center text-text-muted">
                        No checklist submitted yet
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="px-4 py-3 border-t border-border bg-bg">
            {{ $checklists->links() }}
        </div>
    </div>

</div>
@endsection
