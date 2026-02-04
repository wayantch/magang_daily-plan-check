@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <x-header title="Edit Area" />
        <x-alert />


    <form method="POST" action="{{ route('areas.update', $area->id) }}"
          class="bg-card border border-border rounded-xl p-6 space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="text-sm text-text-secondary">Area Name</label>
            <input name="name" required
                   value="{{ old('name', $area->name) }}"
                   class="w-full mt-1 px-4 py-2 bg-bg border border-border rounded-lg uppercase">
        </div>

        <div>
            <label class="text-sm text-text-secondary">Has Room?</label>
            <select name="has_room"
                    class="w-full mt-1 px-4 py-2 bg-bg border border-border rounded-lg">
                <option value="1" {{ old('has_room', $area->has_room) == 1 ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('has_room', $area->has_room) == 0 ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <div>
            <label class="text-sm text-text-secondary">Description</label>
            <textarea name="description"
                      class="w-full mt-1 px-4 py-2 bg-bg border border-border rounded-lg">{{ old('description', $area->description) }}</textarea>
        </div>

        <div>
            <label class="text-sm text-text-secondary">Status</label>
            <select name="is_active"
                    class="w-full mt-1 px-4 py-2 bg-bg border border-border rounded-lg">
                <option value="1" {{ old('is_active', $area->is_active) == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ old('is_active', $area->is_active) == 0 ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('areas.index') }}"
               class="px-4 py-2 rounded-lg border border-border text-text-secondary">
                Cancel
            </a>

            <button class="px-4 py-2 rounded-lg bg-primary text-accent-foreground">
                Update
            </button>
        </div>
    </form>
</div>
@endsection
