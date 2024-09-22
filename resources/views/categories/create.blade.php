@extends('layouts.app')

@section('content')

<h1>Create New Category</h1>

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

            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="type"><strong>Type/Name of the Category:</strong></label>
                    <input type="text" name="type" class="form-control" value="{{ old('type') }}">
                </div>
                <div class="form-group mt-3 d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary me-2">Create</button>
                    <a type="button" href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>


        </div>
    </div>
</div>
@endsection