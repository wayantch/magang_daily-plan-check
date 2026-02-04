@extends('layouts.app')
@section('content')

@include('components.header')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-5">
        <!-- Example Card -->
        <div class="bg-card border border-border rounded-xl p-6">
            <h2 class="text-lg font-semibold mb-4">Server Status</h2>
            <p class="text-text-secondary">All systems operational.</p>
        </div>

        <div class="bg-card border border-border rounded-xl p-6">
            <h2 class="text-lg font-semibold mb-4">Active Users</h2>
            <p class="text-text-secondary">Currently 120 users online.</p>
        </div>

        <div class="bg-card border border-border rounded-xl p-6">
            <h2 class="text-lg font-semibold mb-4">Recent Alerts</h2>
            <p class="text-text-secondary">No new alerts.</p>
        </div>
    </div>
@endsection
