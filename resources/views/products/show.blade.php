@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to Products</a>
    </div>
    @if (session('success'))
        <script>
            Swal.fire({
                title: 'Success!',
                text: '{{ session("success") }}',
                icon: 'success'
            });
        </script>
    @endif

    @if (session('update_product_information'))
        <script>
            Swal.fire({
                title: 'Update Success!',
                text: '{{ session("update_product_information") }}',
                icon: 'success'
            });
        </script>
    @endif

    <div class="row ">
        <div class="col-md-6">
            <div class="image-container" style="width: 100%; padding-top: 100%; position: relative;">
                <img class="img-fluid"
                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;box-shadow: 0 5px 5px rgba(0, 0, 0, 0.1);"
                    src="{{ asset('storage/product_images/' . $product->product_image) }}"
                    alt="{{ $product->product_name }}">
            </div>
        </div>
        <div class="col-md-6">
            <h1><strong>{{ $product->product_name }}</strong></h1>
            <h2>₱{{ $product->price }}</h2>
            <p>Stock: {{ $product->stock }}</p>
            <hr>
            <label for="description"><Strong>Description:</Strong></label>
            <p>{!! nl2br(e($product->description)) !!}</p>
            <hr>
            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning mx-2">
                <i class="bi bi-pencil-square"></i> Edit
            </a>
            <form id="delete-form" action="{{ route('products.destroy', $product->id) }}" method="POST"
                style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-danger mx-2" id="delete-button">
                    <i class="bi bi-trash3-fill"></i> Delete
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('delete-button').addEventListener('click', function (e) {
        e.preventDefault();

        // Get the product name from the Blade template
        var product_name = @json($product->product_name);

        Swal.fire({
            title: `Are you sure you want to delete "${product_name}"?`, // Use backticks for template literals
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form').submit();
            }
        });
    });
</script>
@endsection