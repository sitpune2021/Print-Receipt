<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">

        <!-- Brand Logo -->
        <a class="sidebar-brand d-flex align-items-center gap-2 px-3 py-3" href="{{ url('/') }}">
            <img src="{{ asset('assets/img/photos/logo.jpg') }}" alt="Logo" height="70" class="rounded-circle shadow-sm">
            <span class="align-middle fw-bold text-primary fs-5 text-white">PrintReceipt</span>
        </a>

        <ul class="sidebar-nav">

            <!-- Dashboard -->
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('/') }}">
                    <i class="fas fa-chart-line me-2"></i>
                    <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <!-- Section Header -->
            <li class="sidebar-header">
                Pages
            </li>

            <!-- Printer Type -->
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('printer.printer-type') }}">
                    <i class="fas fa-layer-group me-2"></i>
                    <span class="align-middle">Printer Type</span>
                </a>
            </li>

            <!-- Printers Management -->
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('printers.index') }}">
                    <i class="fas fa-print me-2"></i>
                    <span class="align-middle">Printers</span>
                </a>
            </li>

        </ul>
    </div>
</nav>
