@extends('layouts.app')

@section('content')

<h1>Edit Category</h1>

<div class="container d-flex justify-content-center align-items-center">
    <div class="card shadow-sm" style="width: 100%; max-width: 800px;">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

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

            <form action="{{ route('categories.update', $category->category_id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="type"><strong>Type:</strong></label>
                    <input type="text" name="type" class="form-control" value="{{ old('type', $category->type) }}">
                </div>
                <div class="form-group mt-3 d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary me-2">Update</button>
                    <a type="button" href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection