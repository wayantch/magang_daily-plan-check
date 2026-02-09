@extends('layouts.app')

@section('content')
    <div class="space-y-6">

        <x-header title="Checklist Template" />
        <x-alert />

            <div class="flex justify-end">
                <a href="{{ route('checklist-templates.create') }}"
                    class="px-4 py-2 bg-primary text-accent-foreground rounded-lg">
                    Create Template
                </a>
            </div>

            <div class="bg-card border border-border rounded-xl overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-bg border-b border-border">
                        <tr class="text-text-secondary">
                            <th class="px-4 py-3 text-left">Location & Equipment</th>
                            <th class="px-4 py-3 text-left">Template</th>
                            <th class="px-4 py-3 text-center">Status</th>
                            <th class="px-4 py-3 text-center">Last Checked By</th>
                            <th class="px-4 py-3 text-center">Date</th>
                            <th class="px-4 py-3 text-right">Action</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-border">
                        @forelse ($templates as $template)
                            <tr class="hover:bg-bg transition">
                                {{-- Location --}}
                                <td class="px-4 py-3">
                                    <div class="font-medium uppercase">
                                        {{ $template->equipment->room->area->name }}
                                        – {{ $template->equipment->room->name }}
                                        – {{ $template->equipment->name }}

                                    </div>
                                </td>

                                {{-- Title --}}
                                <td class="px-4 py-3 font-medium">
                                    {{ $template->title }}
                                </td>


                                {{-- Status --}}
                                <td class="px-4 py-3 text-center">
                                    @if ($template->checklists->count() > 0)
                                        <span
                                            class="px-2 py-1 text-xs rounded-full
                     bg-success text-white">
                                            Done
                                        </span>
                                    @else
                                        <span
                                            class="px-2 py-1 text-xs rounded-full
                     bg-warning text-bg">
                                            Pending
                                        </span>
                                    @endif

                                </td>
                                {{-- Last Checked By --}}
                                <td class="px-4 py-3 text-center">
                                    @if ($template->checklists->count() > 0)
                                        {{ $template->checklists->last()->user->name }}
                                    @else
                                        -
                                    @endif
                                </td>

                                {{-- Date --}}
                                <td class="px-4 py-3 text-center">
                                    {{ $template->checklists->count() > 0 ? $template->checklists->last()->created_at->format('d M Y H:i') : '-' }}
                                </td>

                                {{-- Action --}}
                                <td class="px-4 py-3 text-right">
                                    <div class="inline-flex items-center gap-2">
                                        {{-- Edit --}}
                                        @if ($template->checklists->count() === 0)
                                            {{-- PENDING → BOLEH EDIT --}}
                                            <a href="{{ route('checklist-templates.edit', $template) }}"
                                                class="p-2 rounded-lg text-text-secondary
                      hover:bg-primary-soft hover:text-bg">
                                                <i data-lucide="edit" class="w-4 h-4"></i>
                                            </a>
                                        @else
                                            {{-- DONE → DISABLED --}}
                                            <span class="p-2 rounded-lg text-zinc-500 cursor-not-allowed"
                                                title="Already submitted by operations">
                                                <i data-lucide="lock" class="w-4 h-4"></i>
                                            </span>
                                        @endif
                                        {{-- View (selalu boleh) --}}
                                        <a href="{{ route('checklist-templates.show', $template) }}"
                                            class="p-2 rounded-lg text-text-secondary hover:bg-bg">
                                            <i data-lucide="eye" class="w-4 h-4"></i>
                                        </a>
                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-6 text-center text-text-muted">
                                    No checklist template found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="p-4 border-t border-border bg-bg">
                    {{ $templates->links() }}
                </div>
            </div>

    </div>
@endsection
