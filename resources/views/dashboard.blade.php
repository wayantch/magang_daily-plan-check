@extends('layouts.app')
@section('content')
    @include('components.header')

    {{-- ================= TODAY ACTIVITY ================= --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-5">

        {{-- Fault Today --}}
        <div class="bg-card border border-border rounded-xl p-6">
            <h2 class="text-sm font-semibold mb-4">
                Fault Found Today
            </h2>

            <div class="space-y-3 text-sm max-h-64 overflow-y-auto pr-2">
                @forelse ($recentFaults as $fault)
                    <div class="border-b border-border pb-2 last:border-0">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-medium">
                                    {{ $fault->checklist->template->equipment->name }}
                                </p>
                                <p class="text-xs text-text-muted">
                                    {{ $fault->checklist->template->equipment->room->area->name }}
                                </p>
                            </div>
                            <span class="text-xs text-danger whitespace-nowrap">
                                {{ $fault->created_at->format('H:i') }}
                            </span>
                        </div>
                    </div>
                @empty
                    <p class="text-text-muted text-sm">
                        No fault reported today
                    </p>
                @endforelse
            </div>
        </div>

        {{-- Checklist Activity Today --}}
        <div class="bg-card border border-border rounded-xl p-6">
            <h2 class="text-sm font-semibold mb-4">
                Checklist Activity Today
            </h2>

            <div class="space-y-3 text-sm max-h-32 overflow-y-auto pr-2">
                @forelse ($todayChecklists as $checklist)
                    <div class="border-b border-border pb-2 last:border-0">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-medium">
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
    </div>

    {{-- ================= TODAY INSIGHT ================= --}}
    <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 mt-6">

        {{-- Equipment Condition --}}
        <div class="bg-card border border-border rounded-xl p-6 ">
            <h2 class="text-sm font-semibold mb-4">
                Equipment Condition Today
            </h2>
            <canvas id="equipmentStatusChart"></canvas>
        </div>

        {{-- Fault By Category --}}
        <div class="bg-card border border-border rounded-xl p-6">
            <h2 class="text-sm font-semibold mb-4">
                Fault By Category
            </h2>

            {{-- Dummy / Placeholder --}}
            <p class="text-sm text-text-muted mt-6 text-center">
                No category data available
            </p>
        </div>

        {{-- Fault By Category --}}
        <div class="bg-card border border-border rounded-xl p-6">
            <h2 class="text-sm font-semibold mb-4">
                Fault By Category
            </h2>

            {{-- Dummy / Placeholder --}}
            <p class="text-sm text-text-muted mt-6 text-center">
                No category data available
            </p>
        </div>

        {{-- SLA / Insight Dummy --}}
        <div class="bg-card border border-border rounded-xl p-6">
            <h2 class="text-sm font-semibold mb-4">
                SLA & Response Time
            </h2>

            <ul class="space-y-2 text-sm text-text-muted">
                <li>• Average response: <span class="text-text-primary">-</span></li>
                <li>• Fastest check: <span class="text-text-primary">-</span></li>
                <li>• Longest pending: <span class="text-text-primary">-</span></li>
            </ul>
        </div>
    </div>

    {{-- ================= HISTORY ================= --}}
    <div class="bg-card border border-border rounded-xl p-6 mt-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-sm font-semibold">
                Recent Checklist History
            </h2>

            <a href="{{ route('checklists.index') }}" class="text-xs text-primary hover:underline">
                View All
            </a>
        </div>

        {{-- Dummy Table / Real Data Later --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="border-b border-border text-text-muted">
                    <tr>
                        <th class="py-2 text-left">Equipment</th>
                        <th class="py-2 text-left">Checked By</th>
                        <th class="py-2 text-left">Date</th>
                        <th class="py-2 text-left">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-border">
                        <td class="py-2">CRAH 01</td>
                        <td class="py-2">Ops A</td>
                        <td class="py-2">01 Feb 2026</td>
                        <td class="py-2 text-success">Fault Free</td>
                    </tr>
                    <tr>
                        <td class="py-2">UPS A</td>
                        <td class="py-2">Ops B</td>
                        <td class="py-2">01 Feb 2026</td>
                        <td class="py-2 text-danger">Fault</td>
                    </tr>
                </tbody>
            </table>
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
