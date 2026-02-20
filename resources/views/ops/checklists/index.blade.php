@extends('layouts.ops')

@section('content')
    <div class="space-y-8">

        {{-- HEADER --}}
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold">
                Daily Plan Check
            </h2>

            <span class="text-sm text-text-secondary">
                {{ now()->format('l, d F Y') }}
            </span>
        </div>

        {{-- ========================= --}}
        {{-- CHECKLIST SECTION --}}
        {{-- ========================= --}}
        <div class="space-y-4">
            <h3 class="text-md font-semibold text-text-secondary uppercase tracking-wide">
                Checklist Schedule
            </h3>

            @if ($templates->count())
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach ($templates as $template)
                        <a href="{{ $template->is_done_today ? '#' : route('ops.checklists.create', $template) }}"
                            class="block bg-card border border-border rounded-xl p-5 transition
                   {{ $template->is_done_today ? 'opacity-60 pointer-events-none' : 'hover:border-primary hover:shadow-md' }}">

                            {{-- Location Info --}}
                            <p class="text-xs text-text-secondary uppercase tracking-wide">
                                {{ $template->equipment?->room->area->name }}
                                • {{ $template->equipment->room->name }}
                                • {{ $template->equipment->name }}
                            </p>

                            {{-- Title & Status --}}
                            <div class="flex items-center justify-between mt-3">
                                <h3 class="font-semibold text-base">
                                    {{ $template->title }}
                                </h3>

                                @if ($template->is_done_today)
                                    <span class="text-xs px-3 py-1 rounded-full bg-zinc-700 text-zinc-200">
                                        Done
                                    </span>
                                @else
                                    <span class="text-xs px-3 py-1 rounded-full bg-primary text-bg">
                                        Pending
                                    </span>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="text-center text-text-muted mt-6">
                    No checklist scheduled today
                </div>
            @endif
        </div>
    </div>

    </div>
@endsection
