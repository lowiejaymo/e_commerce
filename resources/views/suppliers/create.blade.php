@extends('layouts.app')

@section('content')

<h1>Create New Supplier</h1>

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

            <form action="{{ route('suppliers.store') }}" method="POST" enctype="multipart/form-data">
            <h3>Supplier Information</h3>
            <hr>
                @csrf
                <div class="form-group">
                    <label for="type"><strong>Name</strong></label>
                    <input type="text" name="name" class="form-control" value="{{ old('type') }}">
                </div>
                <div class="form-group">
                    <label for="type"><strong>Contact Number</strong></label>
                    <input type="number" name="contact_number" class="form-control" value="{{ old('type') }}">
                </div>
                <div class="form-group">
                    <label for="type"><strong>Address</strong></label>
                    <input type="text" name="address" class="form-control" value="{{ old('type') }}">
                </div>
                <div class="form-group">
                    <label for="type"><strong>Email</strong></label>
                    <input type="email" name="email" class="form-control" value="{{ old('type') }}">
                </div>
                <div class="form-group mt-3 d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary me-2">Create</button>
                    <a type="button" href="{{ route('suppliers.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>


        </div>
    </div>
</div>
@endsection