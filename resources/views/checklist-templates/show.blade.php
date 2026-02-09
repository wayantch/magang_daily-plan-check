@extends('layouts.app')

@section('content')
    <div class="space-y-6 ">

        <x-header title="Checklist Template Detail" />

        {{-- Header --}}
        <div class="bg-card border border-border rounded-xl p-4 space-y-1">
            <div class="flex justify-between">
                <p class="text-sm text-text-secondary uppercase">
                    {{ $checklistTemplate->equipment->room->area->name }}
                    - {{ $checklistTemplate->equipment->room->name }}
                    - {{ $checklistTemplate->equipment->name }}
                </p>
                <p class="text-sm text-text-muted">By: {{ $checklistTemplate->checklists->last()->user->name ?? 'No User' }}
                    | {{ $checklistTemplate->created_at->format('d M Y H:i') }}
                </p>
            </div>

            <h2 class="text-lg font-semibold">
                {{ $checklistTemplate->title }}
            </h2>

            @if ($checklistTemplate->description)
                <p class="text-sm text-text-muted">
                    {{ $checklistTemplate->description }}
                </p>
            @endif
        </div>

        {{-- Checklist Items --}}
        <div class="space-y-4">
            <div class="flex justify-between items-baseline">
                <h3 class="text-sm font-semibold text-text-secondary uppercase">
                    Checklist Items
                </h3>
                <p class="text-xs text-text-secondary">{{ $checklistTemplate->items->count() }} items -
                    {{ $latestChecklist?->created_at?->diffForHumans() ?? 'No Checklist' }}
                </p>
            </div>

            @foreach ($checklistTemplate->items as $item)
                @php
                    $result = $latestChecklist
                        ? $latestChecklist->items->firstWhere('checklist_item_template_id', $item->id)
                        : null;
                @endphp

                <div class="bg-card border border-border rounded-xl p-4 space-y-2">

                    <div>
                        <div class="flex justify-between">
                            <p class="font-medium">
                                {{ $item->heading }}
                            </p>
                            {{-- Status --}}
                            @if ($result)
                                @if ($result->status === 'fault_free')
                                    <span
                                        class="inline-flex items-center gap-1.5
                     px-2.5 py-1 text-xs font-medium
                     rounded-full
                     bg-success/15 text-success border border-success/30">
                                        <i data-lucide="check-circle" class="w-3.5 h-3.5"></i>
                                        Fault Free
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1.5
                     px-2.5 py-1 text-xs font-medium
                     rounded-full
                     bg-danger/15 text-danger border border-danger/30">
                                        <i data-lucide="x-circle" class="w-3.5 h-3.5"></i>
                                        Fault
                                    </span>
                                @endif
                            @else
                                <span
                                    class="inline-flex items-center gap-1.5
                 px-2.5 py-1 text-xs
                 rounded-full
                 bg-zinc-800 text-zinc-300 border border-border">
                                    <i data-lucide="minus-circle" class="w-3.5 h-3.5"></i>
                                    Not Checked
                                </span>
                            @endif

                        </div>
                        <p class="text-sm text-text-secondary">
                            {{ $item->subheading }}
                        </p>
                    </div>



                    {{-- Note --}}
                    @if ($result && $result->note)
                        <div class="text-sm text-text-muted border-t border-border pt-2">
                            <span class="font-medium">Note:</span>
                            {{ $result->note }}
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        {{-- Action --}}
        <div class="flex justify-end">
            <a href="{{ route('checklist-templates.index') }}"
                class="px-4 py-2 border border-border rounded-lg text-text-secondary">
                Back
            </a>
        </div>

    </div>
@endsection
