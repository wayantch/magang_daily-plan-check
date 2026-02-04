@php
    $alerts = [
        'success' => [
            'icon' => 'check-circle',
            'class' => 'bg-success/10 text-success border-success/30',
        ],
        'error' => [
            'icon' => 'x-circle',
            'class' => 'bg-danger/10 text-danger border-danger/30',
        ],
        'warning' => [
            'icon' => 'alert-triangle',
            'class' => 'bg-warning/10 text-warning border-warning/30',
        ],
        'info' => [
            'icon' => 'info',
            'class' => 'bg-primary-soft text-bg border-primary/30',
        ],
    ];
@endphp

@foreach ($alerts as $type => $config)
    @if (session()->has($type))
        <div class="flex items-start gap-3 p-4 rounded-lg border mb-4 {{ $config['class'] }}">
            <i data-lucide="{{ $config['icon'] }}" class="w-5 h-5 mt-0.5"></i>
            <div class="flex-1 text-sm">
                {{ session($type) }}
            </div>
        </div>
    @endif
@endforeach

{{-- Validation Errors --}}
@if ($errors->any())
    <div class="flex items-start gap-3 p-4 rounded-lg border mb-4
                bg-danger/10 text-danger border-danger/30">
        <i data-lucide="x-circle" class="w-5 h-5 mt-0.5"></i>
        <div class="text-sm space-y-1">
            @foreach ($errors->all() as $error)
                <p> {{ $error }}</p>
            @endforeach
        </div>
    </div>
@endif

<script>
    setTimeout(() => {
        document.querySelectorAll('[data-alert]')
            .forEach(el => el.remove());
    }, 4000);
</script>
