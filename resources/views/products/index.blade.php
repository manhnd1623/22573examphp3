@extends('layouts.master');

@section('content')
    <h1>Danh sach sp</h1>
    <a href="{{ route('products.create') }}" class="btn btn-primary">Add</a>

    @if (\Session::has('msg'))
        <div class="alert alert-success">
            {{ \Session::get('msg') }}
        </div>
    @endif

    <table class="table">
        <tr>
            <td>Id</td>
            <td>Name</td>
            <td>Price</td>
            <td>Describe</td>
            <td>Image</td>
            <td>Action</td>
        </tr>


        @foreach ($data as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->price }}</td>
                <td>{{ $item->description }}</td>
                <td>
                    <img src="{{ \Storage::url($item->image) }}" alt="" width="50px">

                </td>
                <td>
                    <a href="{{ route('products.edit', $item) }}" class="btn btn-info">Edit</a>
                    <form action="{{ route('products.destroy', $item) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Co chac xoa ko')" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $data->links() }}
@endsection
