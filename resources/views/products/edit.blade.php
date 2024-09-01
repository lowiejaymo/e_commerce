@extends('layouts.app')

@section('content')

<h1>Edit Product</h1>

<div class="container d-flex justify-content-center align-items-center">
    <div class="card shadow-sm" style="width: 100%; max-width: 800px;">

        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="product_name"><Strong>Product Name:</Strong></label>
                    <input type="text" name="product_name" class="form-control" value="{{ old('product_name', $product->product_name) }}">
                </div>
                <div class="form-group">
                    <label for="product_image"><Strong>Product Image:</Strong></label>
                    @if($product->product_image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/product_images/' . $product->product_image) }}" alt="{{ $product->product_name }}" class="img-fluid" style="max-height: 300px; object-fit: cover;">
                        </div>
                    @endif
                    <input type="file" name="product_image" class="form-control">
                </div>
                <div class="form-group">
                    <label for="description"><Strong>Description:</Strong></label>
                    <textarea name="description" class="form-control">{{ old('description', $product->description) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="price"><Strong>Price:</Strong></label>
                    <div class="input-group mb-3">
                        <span class="input-group-text">₱</span>
                        <input type="decimal" class="form-control" name="price" placeholder="Price" aria-label="Price" value="{{ old('price', $product->price) }}">
                    </div>
                </div>
                <div class="form-group mb-4">
                    <label for="stock"><Strong>Stock:</Strong></label>
                    <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}">
                </div>
                <div class="form-group d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary me-2">Update</button>
                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
