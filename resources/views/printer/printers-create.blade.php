@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">

        <!-- Header -->
        <div class="card-header bg-gradient-primary py-4 text-white"
            style="background: linear-gradient(135deg, #00d2ff 0%, #1d2632ff 100%);">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="fw-bold mb-1">
                    <i class="bi bi-printer-fill me-2"></i>
                    {{ isset($printer) ? 'Edit Printers' : 'Add New Printers' }}
                </h3>
            </div>
        </div>

        <!-- Body -->
        <div class="card-body p-4 p-md-5">

            <!-- ✅ Success Message Toast -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Form Start -->
            <form method="POST"
                action="{{ isset($printer) ? route('printers.update', $printer->id) : route('printers.store') }}">
                @csrf
                @if(isset($printer))
                    @method('PUT')
                @endif

                <div class="row">
                    <div class="col-md-6">

                        <!-- Printer Type ID -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-muted small">PRINTER TYPE NAME<span class="text-danger">* </span></label>
                            <select name="printer_type_id" class="form-select form-select-lg">
                                <option value="" disabled selected>Select Printer Type</option>
                                @foreach ($printerTypes as $type)
                                    <option value="{{ $type->id }}"
                                        {{ old('printer_type_id', $printer->printer_type_id ?? '') == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('printer_type_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- MAC Address -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-muted small">MAC ADDRESS<span class="text-danger">* </span></label>
                            <input type="text" name="mac_address"
                                class="form-control form-control-lg @error('mac_address') is-invalid @enderror"
                                placeholder="Enter MAC Address"
                                value="{{ old('mac_address', $printer->mac_address ?? '') }}">
                            @error('mac_address')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Model -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-muted small">MODEL<span class="text-danger">* </span></label>
                            <input type="text" name="model"
                                class="form-control form-control-lg @error('model') is-invalid @enderror"
                                placeholder="Enter Model"
                                value="{{ old('model', $printer->model ?? '') }}">
                            @error('model')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">

                        <!-- Display Name -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-muted small">DISPLAY NAME<span class="text-danger">* </span></label>
                            <input type="text" name="display_name"
                                class="form-control form-control-lg @error('display_name') is-invalid @enderror"
                                placeholder="Enter Display Name"
                                value="{{ old('display_name', $printer->display_name ?? '') }}">
                            @error('display_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Registered By -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-muted small">REGISTERED BY</label>
                            <input type="text" name="registered_by"
                                class="form-control form-control-lg"
                                value="{{ Auth::check() ? Auth::user()->name : '' }}" readonly>
                        </div>

                        <!-- Registration Date -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-muted small">REGISTRATION DATE</label>
                            <input type="text" name="registration_date"
                                class="form-control form-control-lg"
                                value="{{ now()->toDateString() }}" readonly>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="d-flex justify-content-end align-items-center border-top pt-4 mt-2">
                    <a href="{{ route('printers.index') }}" class="btn px-4 shadow-sm text-white"
                        style="background-color: #1A3645;">
                        <i class="bi bi-arrow-left me-2"></i> {{ isset($editData) ? 'Back' : 'Cancel' }}
                    </a>

                    <button type="submit" class="btn px-4 shadow-sm text-white ms-3"
                        style="background-color: #1A3645;">
                        <i class="bi bi-save me-2"></i> {{ isset($printer) ? 'Update' : 'Save' }}
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
