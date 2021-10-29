@extends('layouts.app')
@section('content')
    @if (session('forceDelete'))
        <div class="alert alert-danger">
            <ul>
                {{ session('forceDelete') }}
            </ul>
        </div>
    @endif
    @if (session('delete'))
        <div class="alert alert-danger">
            <ul>
                {{ session('delete') }}
            </ul>
        </div>
    @endif
    @if (session('product'))
        <div class="alert alert-success">
            <ul>
                {{ session('product') }}
            </ul>
        </div>
    @endif
    <div class="container">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Author</th>
                        <th scope="col">Image</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <th scope="row">{{ $product->id }}</th>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->name }}</td>
                            <td>
                                <img class="ratio" style="max-height: 50px;"
                                    src="{{ asset('storage/images/' . $product->image) }}" />
                            </td>
                            <td>
                                @if ($product->deleted_at) not active @else active @endif
                            </td>
                            <td>
                                @if ($product->deleted_at)
                                    <form style="display:inline" method="post"
                                        action="{{ route('product.restore', $product) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-success" type="submit">Restore</button>
                                    </form>
                                    <form style="display:inline" method="post" onclick="return confirm('Deactivate user permenantly?')"
                                        action="{{ route('product.forceDelete', $product) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-dark" type="submit">Force Delete</button>
                                    </form>
                                @else
                                    <a href="{{ route('product.edit', $product) }}" class="btn btn-primary">Edit</a>
                                    <form style="display:inline" method="post" onclick="return confirm('Delete user?')"
                                        action="{{ route('product.destroy', $product) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="m-6">
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection
