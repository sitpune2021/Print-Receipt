@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Printers List</h2>
        <a href="{{ route('printers.create') }}" class="btn btn-dark">
            <i class="fas fa-plus-circle"></i> Add Printer
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
            <thead style="background: linear-gradient(135deg, #00d2ff 0%, #1d2632ff 100%); color:white">
                <tr>
                    <th>Sr No</th>
                    <th>MAC Address</th>
                    <th>Model</th>
                    <th>Printer Type</th>
                     <th>Display Name</th>
                    <th>Registered By</th>
                    <th>Registration Date</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($printers as $printer)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td style="max-width: 180px; word-wrap: break-word; white-space: normal;">{{ $printer->mac_address }}</td>
                        <td>{{ $printer->model }}</td>
                        <td>{{ $printer->printerType->name }}</td>
                        <td style="max-width: 200px; word-wrap: break-word; white-space: normal;">{{ $printer->display_name }}</td>
                        <td style="max-width: 150px; word-wrap: break-word; white-space: normal;">{{ $printer->registeredUser->name ?? 'Unknown User' }}</td>
                        <td>{{ $printer->registration_date }}</td>
                        <td class="text-center">
                            <a href="{{ route('printers.edit', $printer->id) }}" class="btn btn-sm btn-outline-primary me-2" title="Edit">
                                <i class="fas fa-pen-to-square"></i>
                            </a>
                            <a href="{{ route('printers.delete', $printer->id) }}"
                               class="btn btn-sm btn-outline-danger" title="Delete"
                               onclick="return confirm('Are you sure you want to delete this printer?')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach

                @if($printers->isEmpty())
                    <tr>
                        <td colspan="8" class="text-center text-muted">No printers found.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

