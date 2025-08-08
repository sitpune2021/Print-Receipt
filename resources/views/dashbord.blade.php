@extends('layouts.app')

@section('content')
<h4 class="mb-4 fw-bold">📊 Dashboard Overview</h4>

{{-- Include Bootstrap Icons CDN --}}
@push('head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
@endpush

<style>
    .glass-card {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 1rem;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease-in-out;
        text-decoration: none !important; /* prevent underline */
        color: inherit; /* keep original text color */
    }
    .glass-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
        text-decoration: none !important;
        color: inherit;
    }
    .glass-icon {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-size: 24px;
        font-weight: bold;
    }
</style>

<div class="row g-4">



    <!-- Printer Types Card -->
    <div class="col-md-4">
        <a href="{{ route('printer.printer-type') }}" class="glass-card p-4 text-dark bg-light d-block">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted">Printer Types</h6>
                    <h2 class="fw-bold">{{ $printerTypeCount }}</h2>
                </div>
                <div class="glass-icon bg-warning text-white">
                    <i class="fas fa-layer-group"></i>
                </div>
            </div>
        </a>
    </div>


    <!-- Printers Card -->
    <div class="col-md-4">
        <a href="{{ route('printers.index') }}" class="glass-card p-4 text-dark bg-light d-block">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted">Total Printers</h6>
                    <h2 class="fw-bold">{{ $printerCount }}</h2>
                </div>
                <div class="glass-icon bg-success text-white">
                       <i class="fas fa-print"></i>
                </div>
            </div>
        </a>
    </div>

</div>
@endsection
