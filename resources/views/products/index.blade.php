@extends('layouts.app')

@section('sidebar')
<div class="card mb-4 d-none d-md-block"> <!-- Sidebar hidden on smaller screens -->
    <div class="card-header">
        <h5>Filters</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('products.index') }}" method="GET">
            <div class="mb-3">
                <h6>Category</h6>
                @foreach($categories as $category)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="categories[]"
                            value="{{ $category->category_id }}" {{ request()->has('categories') && in_array($category->category_id, request('categories')) ? 'checked' : '' }}>
                        <label class="form-check-label">{{ $category->type }}</label>
                    </div>
                @endforeach
            </div>

            <div class="mb-3">
                <h6>Price</h6>
                <input type="number" name="min_price" class="form-control mb-2" placeholder="Min price"
                    value="{{ request('min_price') }}">
                <input type="number" name="max_price" class="form-control mb-2" placeholder="Max price"
                    value="{{ request('max_price') }}">
            </div>

            <button type="submit" class="btn btn-dark w-100">Apply Filters</button>
        </form>
    </div>
</div>
@endsection

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Products</h1>
        <a href="{{ route('products.create') }}" class="btn btn-dark d-flex align-items-center">
            <i class="bi bi-plus-square"></i>
            <span class="d-none d-md-inline ms-2">Create New Product</span>
        </a>
    </div>

    <!-- Search Bar in Desktop View -->
    <div class="d-none d-md-block mb-3">
        <form action="{{ route('products.index') }}" method="GET" class="w-100">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search products..."
                    value="{{ request('search') }}">
                <button class="btn btn-outline-secondary" type="submit">
                    <i class="bi bi-search-heart"></i>
                </button>
            </div>
        </form>
    </div>

    <!-- Mobile Toggle for Filters and Search -->
    <div class="d-md-none mb-3">
        <!-- Button for toggling filters -->
        <button class="btn btn-light w-100 mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#mobileFilters"
            aria-expanded="false" aria-controls="mobileFilters">
            <i class="bi bi-filter"></i> Show Filters
        </button>
        <!-- Button for toggling search -->
        <button class="btn btn-light w-100" type="button" data-bs-toggle="collapse" data-bs-target="#mobileSearch"
            aria-expanded="false" aria-controls="mobileSearch">
            <i class="bi bi-search-heart"></i> Search Product
        </button>
    </div>

    <!-- Collapsible Mobile Filters -->
    <div class="collapse mb-4" id="mobileFilters">
        <div class="card card-body">
            <form action="{{ route('products.index') }}" method="GET">
                <!-- Category Filter -->
                <div class="mb-3">
                    <h6>Category</h6>
                    @foreach($categories as $category)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="categories[]"
                                value="{{ $category->category_id }}" {{ request()->has('categories') && in_array($category->category_id, request('categories')) ? 'checked' : '' }}>
                            <label class="form-check-label">{{ $category->type }}</label>
                        </div>
                    @endforeach
                </div>

                <!-- Price Filter -->
                <div class="mb-3">
                    <h6>Price</h6>
                    <input type="number" name="min_price" class="form-control mb-2" placeholder="Min price"
                        value="{{ request('min_price') }}">
                    <input type="number" name="max_price" class="form-control mb-2" placeholder="Max price"
                        value="{{ request('max_price') }}">
                </div>

                <!-- Apply Filters Button -->
                <button type="submit" class="btn btn-dark w-100">Apply Filters</button>
            </form>
        </div>
    </div>

    <!-- Collapsible Mobile Search -->
    <div class="collapse mb-4" id="mobileSearch">
        <div class="card card-body">
            <form action="{{ route('products.index') }}" method="GET" class="w-100">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search products..."
                        value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary" type="submit">
                        <i class="bi bi-search-heart"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    @if($products->isEmpty())
        <div class="text-center">
            <p>We're sorry, no results found for <strong>"{{ request('search') }}."</strong></p>
        </div>
    @else
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
                    title: 'Success!',
                    html: '<strong>{{ session("deleted_product") }}</strong> has been deleted from your product list successfully.',
                    icon: 'success'
                });
            </script>
        @endif

        <!-- Product Grid -->
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach($products as $product)
                <div class="col">
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

                            <div class="mt-auto price-container" style="min-height: 60px;">
                                @if($product->product_discount > 0)
                                                @php
                                                    $discounted_price = $product->price - ($product->price * $product->product_discount / 100);
                                                @endphp
                                                <h4 class="text-left">
                                                    <span
                                                        style="text-decoration: line-through; color: grey; font-size: 1.3rem;">₱{{ number_format($product->price, 2) }}</span>
                                                    <span style="font-size: 0.8rem; color: green;">-{{ $product->product_discount }}%</span>
                                                </h4>
                                                <h4 class="text-left" style="color: brown; margin-top: 5px;">
                                                    <strong>₱{{ number_format($discounted_price, 2) }}</strong></h4>
                                @else
                                    <h4 class="text-left"><strong>₱{{ number_format($product->price, 2) }}</strong></h4>
                                @endif
                            </div>

                            <div class="mt-auto">
                                <p class="text-left">Stock: {{ $product->stock }}</p>
                            </div>
                        </div>

                    </a>
                </div>
            @endforeach
        </div>

    @endif
</div>

<script>
    window.addEventListener('beforeunload', function () {
        sessionStorage.setItem('scrollPosition', window.scrollY);
    });

    window.addEventListener('load', function () {
        const scrollPosition = sessionStorage.getItem('scrollPosition');
        if (scrollPosition !== null) {
            window.scrollTo(0, scrollPosition);
        }
    });
</script>
@endsection