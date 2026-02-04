@extends('layouts.app')

@section('content')
<div class="max-w-4xl space-y-6">

    <x-header title="Daily Plan Check" />

    <form method="POST" action="{{ route('checklist.store') }}"
          class="bg-card border border-border rounded-xl p-6 space-y-6">
        @csrf

        <!-- Meta -->
        <div class="grid grid-cols-3 gap-4">
            <input type="date" name="check_date"
                   value="{{ now()->toDateString() }}"
                   class="bg-bg border border-border rounded-lg px-4 py-2">

            <select name="area_id"
                    class="bg-bg border border-border rounded-lg px-4 py-2">
                @foreach ($areas as $area)
                    <option value="{{ $area->id }}">{{ $area->name }}</option>
                @endforeach
            </select>

            <select name="room_id"
                    class="bg-bg border border-border rounded-lg px-4 py-2">
                <option value="">No Room</option>
            </select>
        </div>

        <!-- Equipment List -->
        <div class="space-y-4">
            @foreach (\App\Models\Equipment::where('is_active', true)->get() as $index => $equipment)
                <div class="flex items-center gap-4 border border-border rounded-lg p-4">
                    <input type="hidden"
                           name="items[{{ $index }}][equipment_id]"
                           value="{{ $equipment->id }}">

                    <div class="flex-1 font-medium">
                        {{ $equipment->name }}
                    </div>

                    <select name="items[{{ $index }}][condition]"
                            class="bg-bg border border-border rounded-lg px-3 py-2">
                        <option value="normal">Normal</option>
                        <option value="abnormal">Abnormal</option>
                        <option value="not_working">Not Working</option>
                    </select>

                    <input type="text"
                           name="items[{{ $index }}][note]"
                           placeholder="Note"
                           class="bg-bg border border-border rounded-lg px-3 py-2 w-64">
                </div>
            @endforeach
        </div>

        <div class="flex justify-end">
            <button class="px-6 py-2 rounded-lg bg-primary text-accent-foreground">
                Submit Checklist
            </button>
        </div>
    </form>

</div>
@endsection
