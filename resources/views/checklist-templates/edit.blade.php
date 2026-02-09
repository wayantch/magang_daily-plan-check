@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <x-header title="Edit Checklist Template" />
    <x-alert />

    <form method="POST"
          action="{{ route('checklist-templates.update', $checklistTemplate) }}"
          class="bg-card border border-border rounded-xl p-6 space-y-6">
        @csrf
        @method('PUT')

        {{-- Equipment --}}
        <div>
            <label class="text-sm text-text-secondary">Equipment</label>
            <p class="text-xs text-text-muted my-1">Area → Room → Equipment</p>
            <select name="equipment_id" required
                class="w-full mt-1 px-4 py-2 bg-bg border border-border rounded-lg uppercase">
                @foreach ($equipments as $equipment)
                    <option value="{{ $equipment->id }}"
                        {{ $equipment->id == $checklistTemplate->equipment_id ? 'selected' : '' }}>
                        {{ $equipment->room->area->name }}
                        - {{ $equipment->room->name }}
                        - {{ $equipment->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Title --}}
        <div>
            <label class="text-sm text-text-secondary">Title</label>
            <input name="title"
                   value="{{ old('title', $checklistTemplate->title) }}"
                   required
                   class="w-full mt-1 px-4 py-2 bg-bg border border-border rounded-lg">
        </div>

        {{-- Description --}}
        <div>
            <label class="text-sm text-text-secondary">Description</label>
            <textarea name="description"
                class="w-full mt-1 px-4 py-2 bg-bg border border-border rounded-lg">{{ old('description', $checklistTemplate->description) }}</textarea>
        </div>

        {{-- Checklist Items --}}
        <div class="space-y-3">
            <label class="text-sm text-text-secondary">Checklist Items</label>

            <div id="items" class="space-y-2">
                @foreach ($checklistTemplate->items as $i => $item)
                    <div class="grid grid-cols-2 gap-3 items-center">
                        <input name="items[{{ $i }}][heading]"
                               value="{{ $item->heading }}"
                               class="px-3 py-2 bg-bg border rounded-lg" required>

                        <div class="flex gap-2">
                            <input name="items[{{ $i }}][subheading]"
                                   value="{{ $item->subheading }}"
                                   class="px-3 py-2 bg-bg border rounded-lg flex-1" required>

                            <button type="button"
                                    onclick="this.parentElement.parentElement.remove()"
                                    class="px-3 rounded-lg bg-danger text-white">
                                ✕
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <button type="button"
                    onclick="addItem()"
                    class="text-sm text-primary">
                + Add Item
            </button>
        </div>

        {{-- Action --}}
        <div class="flex justify-end gap-3 pt-4">
            <a href="{{ route('checklist-templates.index') }}"
               class="px-4 py-2 border border-border rounded-lg">
                Cancel
            </a>
            <button class="px-6 py-2 bg-primary text-accent-foreground rounded-lg">
                Update Template
            </button>
        </div>
    </form>

</div>

<script>
    let index = {{ $checklistTemplate->items->count() }};

    function addItem() {
        const container = document.getElementById('items');
        const div = document.createElement('div');
        div.className = 'grid grid-cols-2 gap-3 items-center mt-2';
        div.innerHTML = `
            <input name="items[${index}][heading]"
                   placeholder="Heading"
                   class="px-3 py-2 bg-bg border rounded-lg" required>

            <div class="flex gap-2">
                <input name="items[${index}][subheading]"
                       placeholder="Sub Heading"
                       class="px-3 py-2 bg-bg border rounded-lg flex-1" required>

                <button type="button"
                        onclick="this.parentElement.parentElement.remove()"
                        class="px-3 rounded-lg bg-danger text-white">
                    ✕
                </button>
            </div>
        `;
        container.appendChild(div);
        index++;
    }
</script>
@endsection
