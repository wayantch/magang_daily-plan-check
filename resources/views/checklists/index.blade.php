@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <x-header title="My Checklist History" />

    <div class="bg-card border border-border rounded-xl overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-bg border-b border-border">
                <tr>
                    <th class="px-4 py-3">Date</th>
                    <th class="px-4 py-3">Equipment</th>
                    <th class="px-4 py-3">Total Items</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-border">
                @foreach ($checklists as $checklist)
                <tr>
                    <td class="px-4 py-3">{{ $checklist->check_date }}</td>
                    <td class="px-4 py-3">
                        {{ $checklist->template->equipment->room->area->name }} -
                        {{ $checklist->template->equipment->room->name }} -
                        {{ $checklist->template->equipment->name }}
                    </td>
                    <td class="px-4 py-3">
                        {{ $checklist->items->count() }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
