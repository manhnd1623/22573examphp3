@extends('layouts.master')

@section('content')
    <h1>Them moi sp</h1>


    @if (\Session::has('msg'))
        <div class="alert alert-success">
            {{ \Session::get('msg') }}
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" id="name">

        <label for="price">Price</label>
        <input type="text" class="form-control" name="price" id="price">

        <label for="image">Image</label>
        <input type="file" class="form-control" name="image" id="image">

        <label for="description,">Description,</label>
        <textarea class="form-control" name="description," id="description,"></textarea>

        <a href="{{ route('products.index') }}" class="btn btn-primary" >Return</a>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection
