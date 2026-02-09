@extends('layouts.app')

@section('content')
    <div class="space-y-6 ">

        <x-header title="Create Checklist Template" />
        <x-alert />

        <form method="POST" action="{{ route('checklist-templates.store') }}"
            class="bg-card border border-border rounded-xl p-6 space-y-6">
            @csrf

            {{-- Equipment --}}
            <div>
                <label class="text-sm text-text-secondary">Equipment</label>
                <p class="text-text-secondary text-xs my-2">Note: Area -> Room -> Equipment</p>
                <select name="equipment_id" required class="w-full mt-1 px-4 py-2 bg-bg border border-border rounded-lg uppercase">
                    <option value="">-- Select Equipment --</option>
                    @foreach ($equipments as $equipment)
                        <option value="{{ $equipment->id }}">
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
                <input name="title" required class="w-full mt-1 px-4 py-2 bg-bg border border-border rounded-lg">
            </div>

            {{-- Description --}}
            <div>
                <label class="text-sm text-text-secondary">Description</label>
                <textarea name="description" class="w-full mt-1 px-4 py-2 bg-bg border border-border rounded-lg"></textarea>
            </div>

            {{-- Checklist Items --}}
            <div class="space-y-3">
                <label class="text-sm text-text-secondary">Checklist Items</label>

                <div id="items">
                    <div class="grid grid-cols-2 gap-3">
                        <input name="items[0][heading]" placeholder="Heading" class="px-3 py-2 bg-bg border rounded-lg"
                            required>
                        <input name="items[0][subheading]" placeholder="Sub Heading"
                            class="px-3 py-2 bg-bg border rounded-lg" required>
                    </div>
                </div>

                <button type="button" onclick="addItem()" class="text-sm text-primary">
                    + Add Item
                </button>
            </div>

            {{-- Action --}}
            <div class="flex justify-end gap-3">
                <a href="{{ route('checklist-templates.index') }}" class="px-4 py-2 border rounded-lg">
                    Cancel
                </a>
                <button class="px-6 py-2 bg-primary text-accent-foreground rounded-lg">
                    Save Template
                </button>
            </div>
        </form>
    </div>

    <script>
        let index = 1;

        function addItem() {
            const container = document.getElementById('items');
            const div = document.createElement('div');
            div.className = 'grid grid-cols-2 gap-3 mt-2';
            div.innerHTML = `
        <input name="items[${index}][heading]" placeholder="Heading"
               class="px-3 py-2 bg-bg border rounded-lg" required>
        <input name="items[${index}][subheading]" placeholder="Sub Heading"
               class="px-3 py-2 bg-bg border rounded-lg" required>
    `;
            container.appendChild(div);
            index++;
        }
    </script>
@endsection
