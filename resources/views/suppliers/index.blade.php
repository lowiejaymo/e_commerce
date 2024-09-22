@extends('layouts.app')

@section('content')
<div class="container">

    @if (session('added_success'))
        <script>
            Swal.fire({
                title: 'Success!',
                html: '<strong>{{ session("added_success") }}</strong> has been successfully added to your supplier list.',
                icon: 'success'
            });
        </script>
    @endif

    @if (session('update_success'))
        <script>
            Swal.fire({
                title: 'Success!',
                text: 'Supplier information updated successfully',
                icon: 'success'
            });
        </script>
    @endif

    @if (session('delete_success'))
        <script>
            Swal.fire({
                title: 'Success!',
                text: 'Supplier deleted successfully',
                icon: 'success'
            });
        </script>
    @endif

    <!-- Mobile Toggle for Search -->
    <div class="d-md-none mb-3">
        <button class="btn btn-light w-100" type="button" data-bs-toggle="collapse" data-bs-target="#mobileSearch"
            aria-expanded="false" aria-controls="mobileSearch">
            <i class="bi bi-search-heart"></i> Show Search
        </button>
    </div>

    <!-- Search Form in Desktop View -->
    <div class="d-none d-md-flex justify-content-center mb-4">
        <form action="{{ route('suppliers.index') }}" method="GET" class="w-50">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search suppliers..."
                    value="{{ request('search') }}">
                <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search-heart"></i></button>
            </div>
        </form>
    </div>

    <!-- Collapsible Mobile Search -->
    <div class="collapse mb-4" id="mobileSearch">
        <form action="{{ route('suppliers.index') }}" method="GET" class="w-100">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search suppliers..."
                    value="{{ request('search') }}">
                <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search-heart"></i></button>
            </div>
        </form>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Supplier</h1>
        <a href="{{ route('suppliers.create') }}" class="btn btn-dark">
            <i class="bi bi-plus-square"></i>
            <span class="d-none d-sm-inline">Create New Supplier</span> <!-- Hidden on small screens -->
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Contact Number</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if($suppliers->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center">No suppliers found for <strong>"{{ request('search') }}."</strong></td>
                    </tr>
                @else
                    @foreach($suppliers as $supplier)
                        <tr>
                            <td>{{ $supplier->supplier_id }}</td>
                            <td>{{ $supplier->name }}</td>
                            <td>{{ $supplier->contact_num }}</td>
                            <td>{{ $supplier->email }}</td>
                            <td>{{ $supplier->address }}</td>
                            <td>
                                <a href="{{ route('suppliers.edit', $supplier->supplier_id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form id="delete-form-{{ $supplier->supplier_id }}" action="{{ route('suppliers.destroy', $supplier->supplier_id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $supplier->name }}', {{ $supplier->supplier_id }})">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>

<script>
    function confirmDelete(type, supplierID) {
        Swal.fire({
            title: `Are you sure you want to delete "${type}"?`,
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`delete-form-${supplierID}`).submit();
            }
        });
    }
</script>

<style>
    @media (max-width: 576px) {
        .table-responsive {
            overflow-x: auto;
        }
    }
</style>
@endsection
