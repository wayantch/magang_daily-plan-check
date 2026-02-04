@extends('layouts.app')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <x-header title="Create Type" />
    <x-alert />

    {{-- Form --}}
    <form action="{{ route('types.store') }}" method="POST"
          class="bg-card border border-border rounded-xl p-6 space-y-5">
        @csrf

        {{-- Type Name --}}
        <div>
            <label class="text-sm text-text-secondary">
                Type Name
            </label>
            <input type="text"
                   name="name"
                   value="{{ old('name') }}"
                   required
                   placeholder="Critical, Non-Critical, etc."
                   class="w-full mt-1 px-4 py-2 rounded-lg
                          bg-bg border border-border uppercase
                          focus:outline-none focus:ring-2 focus:ring-primary">
        </div>

        {{-- Description --}}
        <div>
            <label class="text-sm text-text-secondary">
                Description (Optional)
            </label>
            <textarea name="description"
                      rows="3"
                      placeholder="Short description about this type"
                      class="w-full mt-1 px-4 py-2 rounded-lg
                             bg-bg border border-border
                             focus:outline-none focus:ring-2 focus:ring-primary">{{ old('description') }}</textarea>
        </div>

        {{-- Status --}}
        <div>
            <label class="text-sm text-text-secondary">
                Status
            </label>
            <select name="is_active"
                    class="w-full mt-1 px-4 py-2 rounded-lg
                           bg-bg border border-border
                           focus:outline-none focus:ring-2 focus:ring-primary">
                           <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>
                               Inactive
                           </option>
                <option value="1" {{ old('is_active', 1) == 1 ? 'selected' : '' }}>
                    Active
                </option>
            </select>
        </div>

        {{-- Action --}}
        <div class="flex justify-end gap-3 pt-4">
            <a href="{{ route('types.index') }}"
               class="px-4 py-2 rounded-lg
                      border border-border
                      text-text-secondary
                      hover:bg-bg transition">
                Cancel
            </a>

            <button type="submit"
                    class="px-6 py-2 rounded-lg
                           bg-primary text-accent-foreground
                           font-medium hover:bg-primary-hover transition">
                Save Type
            </button>
        </div>
    </form>

</div>
@endsection
