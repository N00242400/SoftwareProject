@extends('layouts.app')

@section('content')
<h1>Create New Category</h1>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

@if($errors->any())
    <div style="color: red;">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('categories.store') }}" method="POST">
    @csrf
    <div>
        <label for="name">Category Name:</label>
        <input type="text" name="name" id="name" required value="{{ old('name') }}">
    </div>
    <div>
        <label for="description">Description (optional):</label>
        <textarea name="description" id="description">{{ old('description') }}</textarea>
    </div>
    <button type="submit">Create Category</button>
</form>

<br>
<a href="{{ route('categories.index') }}">Back to Categories</a>
@endsection