@extends('layouts.app')
@section('content')
    @include('components.header')

    {{-- ================= TODAY ACTIVITY ================= --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-5">
        {{-- Checklist Activity Today --}}
        <div class="bg-card border border-border rounded-xl p-6">
            <h2 class="text-sm font-semibold mb-4">
                Checklist Activity Today
            </h2>

            <div class="space-y-3 text-sm max-h-32 overflow-y-auto pr-2 ">
                @forelse ($todayChecklists as $checklist)
                    <div class="border-b border-border pb-2 last:border-0">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-medium uppercase">
                                    {{ $checklist->template->equipment->name }}
                                </p>
                                <p class="text-xs text-text-muted">
                                    by {{ $checklist->user->name }}
                                </p>
                            </div>
                            <span class="text-xs text-text-muted whitespace-nowrap">
                                {{ $checklist->created_at->format('H:i') }}
                            </span>
                        </div>
                    </div>
                @empty
                    <p class="text-text-muted text-sm">
                        No checklist submitted today
                    </p>
                @endforelse
            </div>
        </div>

        {{-- Fault Today --}}
        <div class="bg-card border border-border rounded-xl p-6 col-span-2">
            <h2 class="text-sm font-semibold mb-4">
                Fault Found Today
            </h2>

            <div class="space-y-3 text-sm max-h-32 overflow-y-auto pr-2">
                @forelse ($recentFaults as $fault)
                    <div class="bg-danger/10 border border-danger/20 rounded-lg p-3">
                        <div class="flex justify-between items-start gap-3">

                            {{-- LEFT: ALARM + INFO --}}
                            <div class="flex items-center gap-3 text-danger uppercase">

                                {{-- Alarm Icon --}}
                                <i data-lucide="bell-ring" class="w-5 h-5  mt-0.5"></i>

                                {{-- Template Title --}}
                                <p class="">
                                    {{ $fault->checklist->template->title }}
                                    |
                                    {{ $fault->checklist->template->equipment->name }}
                                    |
                                    {{ $fault->checklist->template->equipment->room->area->name }}
                                    |
                                    {{ $fault->checklist->template->equipment->room->name }}
                                </p>
                            </div>

                            {{-- RIGHT: TIME --}}
                            <div class="text-right">
                                <p class=" text-danger font-medium">
                                    {{ $fault->created_at->format('H:i') }} /
                                    {{ $fault->created_at->format('d M Y') }}
                                </p>
                            </div>

                        </div>
                    </div>
                @empty
                    <p class="text-text-muted text-sm">
                        No fault reported today
                    </p>
                @endforelse
            </div>
        </div>
    </div>

    {{-- ================= TODAY INSIGHT ================= --}}
    <div class="grid grid-cols-1 sm:grid-cols-5 gap-4 mt-6">

        {{-- Equipment Condition --}}
        <div class="bg-card border border-border rounded-xl p-6 ">
            <h2 class="text-sm font-semibold mb-4">
                Equipment Condition Today
            </h2>
            <canvas id="equipmentStatusChart"></canvas>
        </div>

        {{-- Pending Checklist Today --}}
        <div class="bg-card border border-border rounded-xl p-6">
            <h2 class="text-sm font-semibold mb-4">
                Pending Checklist Today
            </h2>

            <div class="space-y-3 text-sm max-h-64 overflow-y-auto pr-2">
                @forelse ($pendingTemplatesToday as $template)
                    <div class="border-b border-border pb-2 last:border-0">
                        <div class="flex justify-between items-center">
                            <div class="uppercase">
                                <p class="font-medium">
                                    {{ $template->equipment->name }}
                                </p>
                                <p class="text-xs text-text-muted">
                                    {{ $template->equipment->room->area->name }}
                                </p>
                            </div>
                            <span class="text-xs text-warning whitespace-nowrap p-2 bg-warning/20 rounded-full">
                                Pending
                            </span>
                        </div>
                    </div>
                @empty
                    <p class="text-text-muted text-sm">
                        No pending checklist for today
                    </p>
                @endforelse
            </div>
        </div>

        {{-- ================= HISTORY ================= --}}
        <div class="bg-card border border-border rounded-xl p-6 col-span-3 ">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-sm font-semibold">
                    Recent Checklist History
                </h2>

                <a href="{{ route('checklists.index') }}" class="text-xs text-primary hover:underline">
                    View All
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="border-b border-border text-text-muted">
                        <tr>
                            <th class="py-2 text-left">Equipment</th>
                            <th class="py-2 text-left">Checked By</th>
                            <th class="py-2 text-left">Date & Time</th>
                            <th class="py-2 text-left">Result</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recentChecklists as $checklist)
                            @php
                                $hasFault = $checklist->items->contains('status', 'fault');
                            @endphp

                            <tr class="border-b border-border last:border-0">
                                <td class="py-2 uppercase">
                                    <div class="font-medium">
                                        {{ $checklist->template->equipment->name }}
                                    </div>
                                    <div class="text-xs text-text-muted">
                                        {{ $checklist->template->equipment->room->area->name }}
                                    </div>
                                </td>

                                <td class="py-2">
                                    {{ $checklist->user->name }}
                                </td>

                                <td class="py-2 text-xs text-text-muted">
                                    {{ $checklist->created_at->format('d M Y H:i') }}
                                </td>

                                <td class="py-2">
                                    @if ($hasFault)
                                        <span class="text-xs px-2 py-1 rounded-full bg-danger/20 text-danger">
                                            Fault
                                        </span>
                                    @else
                                        <span class="text-xs px-2 py-1 rounded-full bg-success/20 text-success">
                                            Fault Free
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-4 text-center text-text-muted">
                                    No checklist history available
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>


    {{-- ================= CHART ================= --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('equipmentStatusChart');

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Fault Free', 'Fault'],
                datasets: [{
                    data: [{{ $faultFreeCount }}, {{ $faultCount }}],
                    backgroundColor: ['#22c55e', '#ef4444'],
                    borderWidth: 0
                }]
            },
            options: {
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
@endsection
