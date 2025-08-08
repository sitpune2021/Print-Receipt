@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
            <!-- Header -->
            <div class="card-header bg-gradient-primary py-4 text-white"
                style="background: linear-gradient(135deg, #00d2ff 0%, #1d2632ff 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="fw-bold mb-1">Printer Types</h3>

                </div>
            </div>

            <!-- Body -->
            <div class="card-body p-4 p-md-5">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <!-- Create / Update Form -->
                <form
                    action="{{ isset($editData) ? route('printer.printer-type.update', $editData->id) : route('printer.printer-type.store') }}"
                    method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <!-- Printer Type ID -->


                            <!-- Type Name -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold text-muted small">PRINTER TYPE NAME <span class="text-danger">* </span></label>
                                <div class="input-group input-group-lg">

                                    <input type="text" name="name" class="form-control form-control-lg"
                                        value="{{ old('name', $editData->name ?? '') }}" placeholder="Printer Type name">
                                </div>
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Protocol -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold text-muted small">COMMUNICATION PROTOCOL<span class="text-danger">* </span></label>
                                <div class="input-group input-group-lg">

                                    <select class="form-select form-select-lg" name="protocol">
                                        <option value="" disabled
                                            {{ old('protocol', $editData->protocol ?? '') == '' ? 'selected' : '' }}>Select
                                            protocol...</option>
                                        @foreach (['ESC/POS', 'ZPL (Zebra)', 'EPL (Eltron)', 'CPCL', 'Custom'] as $option)
                                            <option value="{{ $option }}"
                                                {{ old('protocol', $editData->protocol ?? '') == $option ? 'selected' : '' }}>
                                                {{ $option }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('protocol')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>



                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-muted small">DESCRIPTION</label>
                        <textarea name="description" class="form-control form-control-lg rounded-3 shadow-sm" rows="4" maxlength="250"
                            placeholder="Describe this printer type, supported models, and special features...">{{ old('description', $editData->description ?? '') }}</textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex justify-content-end align-items-center  pt-4 mt-2">
                        <div class="d-flex gap-3">

                            <button type="button" onclick="window.location.href='{{ url('/printer-type') }}'"
                                class="btn px-4 shadow-sm text-white" style="background-color: #1A3645;">
                                <i class="bi bi-save me-2"></i>{{ isset($editData) ? 'Back' : 'Cancel' }}
                            </button>

                            <button type="submit" class="btn px-4 shadow-sm text-white" style="background-color: #1A3645;">
                                <i class="bi bi-save me-2"></i>{{ isset($editData) ? 'Update' : 'Save' }}
                            </button>

                        </div>
                    </div>
                </form>



            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .bg-gradient-primary {
            background: linear-gradient(135deg, #3a7bd5 0%, #00d2ff 100%);
        }

        .form-control-lg,
        .form-select-lg,
        .input-group-lg .form-control {
            min-height: 50px;
        }

        .form-switch.form-switch-lg .form-check-input {
            width: 4em;
            height: 2em;
        }

        textarea {
            resize: none;
        }

        .card {
            transition: transform 0.2s ease-in-out;
        }

        .card:hover {
            transform: translateY(-5px);
        }
    </style>
@endpush
