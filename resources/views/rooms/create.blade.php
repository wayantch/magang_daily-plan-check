@extends('layouts.app')

@section('content')
    <div class="space-y-6">

        <x-header title="Create Room" />
        <x-alert />

        <form method="POST" action="{{ route('rooms.store') }}" class="bg-card border border-border rounded-xl p-6 space-y-4">
            @csrf

            <div>
                <label class="text-sm text-text-secondary">Area</label>
                <select name="area_id" class="w-full uppercase mt-1 px-4 py-2 bg-bg border border-border rounded-lg">
                    @foreach ($areas as $area)
                        <option value="{{ $area->id }}">{{ $area->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="text-sm text-text-secondary">Room Name</label>
                <input name="name" required
                    class="w-full mt-1 px-4 py-2 bg-bg border border-border rounded-lg uppercase">
            </div>

            <div>
                <label class="text-sm text-text-secondary">Type</label>
                <select name="type_id" class="w-full mt-1 px-4 py-2 bg-bg border border-border rounded-lg uppercase">
                    @if ($types->isEmpty())
                        <option value="">- None -</option>
                    @else
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div>
                <label class="text-sm text-text-secondary">Status</label>
                <select name="is_active" class="w-full mt-1 px-4 py-2 bg-bg border border-border rounded-lg">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>

            <div class="flex justify-end gap-2">
                <a href="{{ route('rooms.index') }}" class="px-4 py-2 rounded-lg border border-border text-text-secondary">
                    Cancel
                </a>

                <button class="px-4 py-2 rounded-lg bg-primary text-accent-foreground">
                    Save
                </button>
            </div>
        </form>
    </div>
@endsection
