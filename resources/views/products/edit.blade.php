@extends('layouts.master')

@section('content')
    <h1>Cap nhap sp: {{ $product->name }}</h1>

    @if (\Session::has('msg'))
        <div class="alert alert-success">
            {{ \Session::get('msg') }}
        </div>
    @endif

    <form action="{{ route('products.update', $product) }}"method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" id="name" value="{{ $product->name }}">

        <label for="price">Price</label>
        <input type="text" class="form-control" name="price" id="price" value="{{ $product->price }}">



        <label for="description,">Description,</label>
        <textarea  class="form-control" name="description," id="description,">{{ $product->description }}</textarea>

        <label for="image">Image</label>
        <input type="file" class="form-control" name="image" id="image">
        <img src="{{ \Storage::url($product->image) }}" alt="" width="50px">


        <a href="{{ route('products.index') }}" class="btn btn-primary">Return</a>
        <button type="submit" class="btn btn-primary">Save</button>

    </form>
@endsection
