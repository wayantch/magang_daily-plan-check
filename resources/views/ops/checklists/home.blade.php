@extends('layouts.ops')

@section('content')
    <div class="space-y-4">

        <h2 class="text-lg font-semibold">
            Daily Plan Check
        </h2>

        @forelse ($templates as $template)
            <a href="{{ $template->is_done_today ? '#' : route('ops.checklists.create', $template) }}"
                class="block bg-card border border-border rounded-xl p-4
                  {{ $template->is_done_today ? 'opacity-50 pointer-events-none' : 'hover:border-primary' }}">

                <p class="text-sm text-text-secondary uppercase">
                    {{ $template->equipment->room->area->name }}
                    - {{ $template->equipment->room->name }}
                    - {{ $template->equipment->name }}
                </p>

                <div class="flex items-center justify-between mt-2">
                    <h3 class="font-semibold">
                        {{ $template->title }}
                    </h3>

                    @if ($template->is_done_today)
                        <span class="text-xs px-2 py-1 rounded-full bg-zinc-700 text-zinc-200">
                            Done
                        </span>
                    @else
                        <span class="text-xs px-2 py-1 rounded-full bg-primary text-bg">
                            Pending
                        </span>
                    @endif
                </div>
            </a>
        @empty
            <div class="text-center text-text-muted mt-10">
                No checklist scheduled today
            </div>
        @endforelse

    </div>
@endsection
