@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <x-header title="Edit Category" />
    <x-alert />

    <form method="POST" action="{{ route('categories.update', $category->id) }}"
          class="bg-card border border-border rounded-xl p-6 space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="text-sm text-text-secondary">Category Name</label>
            <input name="name" required
                   value="{{ old('name', $category->name) }}"
                   placeholder="Cooling / Electrical"
                   class="w-full mt-1 px-4 py-2 rounded-lg
                          bg-bg border border-border uppercase">
        </div>

        <div>
            <label class="text-sm text-text-secondary">Description</label>
            <textarea name="description"
                      class="w-full mt-1 px-4 py-2 rounded-lg
                             bg-bg border border-border">{{ old('description', $category->description) }}</textarea>
        </div>

        <div>
            <label class="text-sm text-text-secondary">Status</label>
            <select name="is_active"
                    class="w-full mt-1 px-4 py-2 rounded-lg
                           bg-bg border border-border">
                <option value="1" {{ old('is_active', $category->is_active) == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ old('is_active', $category->is_active) == 0 ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('categories.index') }}"
               class="px-4 py-2 rounded-lg border border-border text-text-secondary">
                Cancel
            </a>
            <button class="px-6 py-2 rounded-lg bg-primary text-accent-foreground">
                Save
            </button>
        </div>
    </form>

</div>
@endsection
