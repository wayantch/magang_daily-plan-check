@extends('layouts.app')

@section('content')
    <div class="space-y-6">

        <x-header title="Create Equipment" />
        <x-alert />

        <form method="POST" action="{{ route('equipments.store') }}"
            class="bg-card border border-border rounded-xl p-6 space-y-4">
            @csrf

            <div>
                <label class="text-sm text-text-secondary">Room</label>
                <select name="room_id" required class="w-full mt-1 px-4 py-2 rounded-lg bg-bg border border-border uppercase">
                    <option value="">-- Select Room --</option>
                    @foreach ($rooms as $room)
                        <option value="{{ $room->id }}">
                            {{ $room->area->name }} - {{ $room->name }}
                        </option>
                    @endforeach
                </select>
            </div>


            <div>
                <label class="text-sm text-text-secondary">Equipment Name</label>
                <input name="name" required
                    class="w-full mt-1 px-4 py-2 bg-bg border border-border rounded-lg uppercase">
            </div>

            <div>
                <label class="text-sm text-text-secondary ">Category</label>
                <select name="category_id" class="w-full mt-1 px-4 py-2 bg-bg border border-border rounded-lg uppercase">
                    <option value="">- None -</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            {{--
            <div>
                <label class="text-sm text-text-secondary">Category</label>
                <input name="category" placeholder="Cooling / Electrical"
                    class="w-full mt-1 px-4 py-2 bg-bg border border-border rounded-lg">
            </div> --}}

            <div>
                <label class="text-sm text-text-secondary">Status</label>
                <select name="is_active" class="w-full mt-1 px-4 py-2 bg-bg border border-border rounded-lg">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>

            <div class="flex justify-end gap-2">
                <a href="{{ route('equipments.index') }}"
                    class="px-4 py-2 rounded-lg border border-border text-text-secondary">
                    Cancel
                </a>

                <button class="px-4 py-2 rounded-lg bg-primary text-accent-foreground">
                    Save
                </button>
            </div>
        </form>
    </div>
@endsection
