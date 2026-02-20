    @extends('layouts.app')

    @section('content')
        <div class="space-y-6">

            <x-header title="Checklist History" />
            <div class="flex items-center justify-between">
                <div class="">
                    <h2 class="text-lg font-semibold text-text-primary">
                        Checklist History
                    </h2>
                    <p class="text-sm text-text-muted">
                        List of submitted checklists
                    </p>
                </div>

                {{-- Filter By --}}
                <div class="flex items-center gap-2">
                    {{-- Export excel/pdf --}}
                    <div class="">
                        <button
                            class="px-4 py-2 bg-bg border border-border rounded-lg text-text-secondary hover:bg-primary-soft hover:text-bg transition">
                            Export
                        </button>
                    </div>
                    <select name="status" id="status" class="px-4 py-2 rounded-lg bg-bg border border-border">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="100">All</option>
                    </select>
                    {{-- <label for="status" class="text-sm text-text-secondary">Filter By:</label> --}}
                    {{-- icon filter --}}
                    <div class="p-2 bg-bg border border-border rounded-lg">
                        <i data-lucide="filter" class="text-text-secondary"></i>
                    </div>
                </div>
            </div>

                <div class="bg-card border border-border rounded-xl ">
                    <table class="w-full text-sm">
                        <thead class="bg-bg border-b border-border">
                            <tr class="text-text-secondary">
                                <th class="px-4 py-3 text-left">#</th>
                                <th class="px-4 py-3 text-left">Title</th>
                                <th class="px-4 py-3 text-left">Equipment</th>
                                <th class="px-4 py-3 text-left">Checked By</th>
                                <th class="px-4 py-3 text-left">Date</th>
                                <th class="px-4 py-3 text-left">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($checklists as $checklist)
                                @php
                                    $hasFault = $checklist->items->contains('status', 'fault');
                                @endphp

                                <tr class="border-b border-border last:border-0">
                                    <td class="px-4 py-2">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="px-4 py-2 font-medium line-clamp-1">
                                        {{ $checklist->template->title }}
                                    </td>
                                    <td class="px-4 py-2 uppercase">
                                        <div class="font-medium">
                                            {{ $checklist->template->equipment->name }} - {{ $checklist->template->equipment->room->name }}
                                        </div>
                                        <div class="text-xs text-text-muted">
                                            {{ $checklist->template->equipment->room->area->name }}
                                        </div>
                                    </td>

                                    <td class="px-4 py-2">
                                        {{ $checklist->user->name }}
                                    </td>

                                    <td class="px-4 py-2 text-xs text-text-muted">
                                        {{ $checklist->created_at->format('d M Y H:i') }}
                                    </td>

                                    <td class="px-4 py-2">
                                        @if ($hasFault)
                                            <span class="text-xs px-2 py-1 rounded-full bg-danger/20 text-danger">
                                                Fault
                                            </span>
                                        @else
                                            <span class="text-xs px-2 py-1 rounded-full bg-success/20 text-success">
                                                Fault Free
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-4 text-center text-text-muted">
                                        No checklist history available
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

    </div>
    @endsection
