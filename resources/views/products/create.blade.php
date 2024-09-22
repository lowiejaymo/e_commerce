@extends('layouts.app')

@section('content')

<h1>Create New Product</h1>

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

            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-4">
                    <label for="product_name"><strong>Product Name</strong></label>
                    <input type="text" name="product_name" class="form-control" value="{{ old('product_name') }}">
                </div>
                <div class="form-group mb-4">
                    <label for="product_image"><strong>Product Image</strong></label>
                    <input type="file" name="product_image" class="form-control">
                    @if (session('old_image'))
                        <div class="mt-2">
                            <img src="{{ asset('storage/product_images/' . session('old_image')) }}" alt="Previous Image"
                                style="max-width: 150px;">
                        </div>
                    @endif
                </div>
                <div class="form-group mb-4">
                    <label for="description"><strong>Description</strong></label>
                    <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                </div>
                <div class="form-group mb-4">
                    <label for="price"><strong>Price</strong></label>
                    <div class="input-group mb-3">
                        <span class="input-group-text">₱</span>
                        <input type="number" class="form-control" name="price" placeholder="Price" aria-label="Price"
                            value="{{ old('price') }}" step="0.01" min="0">
                    </div>
                </div>
                <div class="form-group mb-4">
                    <label for="product_discount"><strong>Discount (%)</strong></label>
                    <div class="input-group mb-3">
                        <span class="input-group-text">%</span>
                        <input type="number" class="form-control" name="product_discount" placeholder="Discount in Percentage" aria-label="Discount"
                            value="{{ old('product_discount') }}" step="0.01" min="0">
                    </div>
                </div>
                <div class="form-group mb-4">
                    <label for="stock"><strong>Stock</strong></label>
                    <input type="number" name="stock" class="form-control" value="{{ old('stock') }}">
                </div>
                <div class="form-group mb-4">
                    <label for="category_id"><strong>Category</strong></label>
                    <select name="category_id" class="form-control">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->category_id }}" {{ old('category_id') == $category->category_id ? 'selected' : '' }}>
                                {{ $category->type }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-4">
                    <label for="supplier_id"><strong>Supplier</strong></label>
                    <select name="supplier_id" class="form-control">
                        <option value="">Select Supplier</option>
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->supplier_id }}" {{ old('supplier_id') == $supplier->supplier_id ? 'selected' : '' }}>
                                {{ $supplier->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group d-flex justify-content-center mt-3">
                    <button type="submit" class="btn btn-primary me-2">Create</button>
                    <a type="button" href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>


        </div>
    </div>
</div>
@endsection