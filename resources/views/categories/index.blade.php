@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <x-header title="Manage Category" />
    <x-alert />

    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-lg font-semibold text-text-primary">Category List</h2>
            <p class="text-sm text-text-muted">
                Equipment system categories
            </p>
        </div>

        <a href="{{ route('categories.create') }}"
           class="inline-flex items-center gap-2 px-4 py-2 rounded-lg
                  bg-primary text-accent-foreground font-medium">
            <i data-lucide="plus"></i>
            Add Category
        </a>
    </div>

    <div class="bg-card border border-border rounded-xl overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-bg border-b border-border">
                <tr class="text-text-secondary">
                    <th class="px-4 py-3 text-left">#</th>
                    <th class="px-4 py-3 text-left">Name</th>
                    <th class="px-4 py-3 text-left">Description</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-right">Action</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-border">
                @forelse ($categories as $category)
                <tr>
                    <td class="px-4 py-3 font-medium uppercase">{{ $loop->iteration }}</td>
                    <td class="px-4 py-3 font-medium uppercase">{{ $category->name }}</td>
                    <td class="px-4 py-3 text-text-secondary uppercase">
                        {{ $category->description ?? '-' }}
                    </td>
                    <td class="px-4 py-3 uppercase">
                        <span class="{{ $category->is_active ? 'text-success' : 'text-danger' }}">
                            {{ $category->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-right">
                        <div class="inline-flex gap-2">
                            <a href="{{ route('categories.edit', $category) }}"
                               class="p-2 rounded-lg hover:bg-primary-soft">
                                <i data-lucide="edit"></i>
                            </a>

                            <form action="{{ route('categories.destroy', $category) }}"
                                  method="POST"
                                  onsubmit="return confirm('Delete this category?')">
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
                    <td colspan="4" class="px-4 py-6 text-center text-text-muted">
                        No category found
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="p-4 border-t border-border bg-bg">
            {{ $categories->links() }}
        </div>
    </div>

</div>
@endsection
