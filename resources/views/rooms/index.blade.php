@extends('layouts.app')

@section('content')
    <div class="space-y-6">

        <x-header title="Manage Room" />
        <x-alert />

        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-lg font-semibold text-text-primary">Room List</h2>
                <p class="text-sm text-text-muted">
                    Manage rooms inside data center areas
                </p>
            </div>

            <a href="{{ route('rooms.create') }}"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-lg
                  bg-primary text-accent-foreground font-medium
                  hover:bg-primary-hover transition">
                <i data-lucide="plus"></i>
                Add Room
            </a>
        </div>

        <div class="bg-card border border-border rounded-xl overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-bg border-b border-border">
                    <tr class="text-text-secondary">
                        <th class="px-4 py-3 text-left">#</th>
                        <th class="px-4 py-3 text-left">Room</th>
                        <th class="px-4 py-3 text-left">Area</th>
                        <th class="px-4 py-3 text-left">Type</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-right">Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-border">
                    @forelse ($rooms as $room)
                        <tr class="hover:bg-bg transition">
                            <td class="px-4 py-3 font-medium uppercase">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 font-medium uppercase">{{ $room->name }}</td>

                            <td class="px-4 py-3 text-text-secondary uppercase">
                                {{ $room->area->name }}
                            </td>

                            <td class="px-4 py-3">
                                <span class="text-xs px-2 py-1 rounded-md uppercase">
                                    {{ $room->type->name }}
                                </span>
                            </td>

                            <td class="px-4 py-3">
                                <span class="text-xs uppercase {{ $room->is_active ? 'text-success' : 'text-danger' }}">
                                    {{ $room->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>

                            <td class="px-4 py-3 text-right">
                                <div class="inline-flex gap-2">
                                    <a href="{{ route('rooms.edit', $room) }}" class="p-2 rounded-lg hover:bg-primary-soft">
                                        <i data-lucide="edit"></i>
                                    </a>

                                    <form action="{{ route('rooms.destroy', $room) }}" method="POST"
                                        onsubmit="return confirm('Delete this room?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="p-2 rounded-lg hover:bg-danger hover:text-white">
                                            <i data-lucide="trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-6 text-center text-text-muted">
                                No rooms found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="p-4 border-t border-border bg-bg">
                {{ $rooms->links() }}
            </div>
        </div>

    </div>
@endsection
