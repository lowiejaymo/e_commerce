@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Search Form -->
    <div class="d-flex justify-content-center mb-4">
        <form action="{{ route('products.index') }}" method="GET" class="w-50">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search products..."
                    value="{{ request('search') }}">
                <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search-heart"></i></button>
            </div>
        </form>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Products</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary"><i class="bi bi-plus-square"></i> Create New
            Product</a>
    </div>

    @if (session('success_product_added'))
        <script>
            Swal.fire({
                title: 'Success!',
                html: '<strong>{{ session("success_product_added") }}</strong> has been added to your product list successfully.',
                icon: 'success'
            });
        </script>
    @endif



    @if (session('deleted_product'))
        <script>
            Swal.fire({
                title: 'Deleted!',
                html: '<strong>{{ session("deleted_product") }}</strong> has been deleted from your product list successfully',
                icon: 'success'
            });
        </script>
    @endif

    <div class="row">
        @foreach ($products as $product)
            <div class="col-6 col-md-4 col-lg-3 mb-4 d-flex">
                <a href="{{ route('products.show', $product->id) }}" class="card-link d-flex flex-column"
                    style="width: 100%; max-width: 300px; box-shadow: 0 5px 5px rgba(0, 0, 0, 0.1); text-decoration: none; color: inherit;">
                    <div class="text-center p-0 flex-shrink-0">
                        <div class="image-container" style="width: 100%; padding-top: 100%; position: relative;">
                            <img class="profile-picture img-fluid"
                                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;"
                                src="{{ asset('storage/product_images/' . $product->product_image) }}"
                                alt="{{ $product->product_name }}">
                        </div>
                    </div>
                    <div class="card-body d-flex flex-column flex-grow-1 p-3">
                        <h1 class="text-left"
                            style="font-size: 20px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                            {{ $product->product_name }}
                        </h1>
                        <div class="mt-auto">
                            <h4 class="text-left"><strong>₱{{ $product->price }}</strong></h4>
                        </div>
                        <div class="mt-auto">
                            <p class="text-left">Stock: {{ $product->stock }}</p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection