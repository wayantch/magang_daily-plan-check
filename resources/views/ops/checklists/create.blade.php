@extends('layouts.ops')

@section('content')
<div class="space-y-6 ">

    <x-header title="Checklist Execution" />
    <x-alert />

    <div class="bg-card border border-border rounded-xl p-4">
        <p class="text-sm text-text-secondary">
            {{ $template->equipment->room->area->name }} -
            {{ $template->equipment->room->name }} -
            {{ $template->equipment->name }}
        </p>
        <h2 class="text-lg font-semibold">{{ $template->title }}</h2>
    </div>

    <form method="POST"
          action="{{ route('ops.checklists.store', $template) }}"
          class="space-y-4">
        @csrf

        @foreach ($template->items as $item)
        <div class="bg-card border border-border rounded-xl p-4 space-y-2">
            <p class="font-medium">{{ $item->heading }}</p>
            <p class="text-sm text-text-secondary">{{ $item->subheading }}</p>

            <div class="flex gap-6">
                <label class="flex items-center gap-2">
                    <input type="radio"
                           name="items[{{ $item->id }}][status]"
                           value="fault_free"
                           required>
                    Fault Free
                </label>

                <label class="flex items-center gap-2 text-danger">
                    <input type="radio"
                           name="items[{{ $item->id }}][status]"
                           value="fault">
                    Fault
                </label>
            </div>

            <textarea name="items[{{ $item->id }}][note]"
                      placeholder="Note (optional)"
                      class="w-full mt-2 px-3 py-2 bg-bg border border-border rounded-lg"></textarea>
        </div>
        @endforeach

        <div class="flex justify-end">
            <button class="px-6 py-2 bg-primary text-accent-foreground rounded-lg">
                Submit Checklist
            </button>
        </div>
    </form>

</div>
@endsection
