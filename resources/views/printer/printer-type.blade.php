@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Printers Type List</h2>
        <a href="{{ route('printer.printer-type.create') }}" class="btn btn-dark">
            <i class="fas fa-plus-circle"></i> Add Printer Type
        </a>
    </div>

@if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true
            });
        });
    </script>
@endif



    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="text-white" style="background: linear-gradient(135deg, #00d2ff 0%, #1d2632ff 100%);">
                <tr>
                    <th>Sr No</th>
                    <th>Name</th>
                    <th>Protocol</th>
                    <th>Description</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($printerTypes as $index => $type)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $type->name }}</td>
                        <td>{{ $type->protocol }}</td>
                        <td style="max-width: 250px; white-space: normal; word-wrap: break-word;">
                            {{ $type->description }}
                        </td>
                        <td class="text-center">
                            <a href="{{ route('printer.printer-type.edit', $type->id) }}" class="btn btn-sm btn-outline-primary me-2">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <form action="{{ route('printer.printer-type.destroy', $type->id) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Are you sure you want to delete this printer type?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">No printer types found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
