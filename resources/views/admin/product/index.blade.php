@extends('layouts.app')
@section('content')
    @if (session('forceDelete'))
        <div class="alert alert-danger">
            <ul>
                {{ session('forceDelete') }}
            </ul>
        </div>
    @endif
    <div class="container">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
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
                                <td>{{ $product->user->name }}</td>
                                <td>
                                    <img class="ratio" style="max-height: 50px;"
                                        src="{{ asset('storage/images/' . $product->image) }}" />
                                </td>
                                <td>
                                    @if($product->deleted_at) not active @else active @endif
                                </td>
                                <td>
                                    <a href="{{ route('product.edit', $product) }}" class="btn btn-primary">Edit</a>
                                    @if ($product->deleted_at)
                                        <a href="{{ route('product.restore', $product) }}"
                                            class="btn btn-success">Restore</a>
                                        <a href="{{ route('product.forceDelete', $product) }}" class="btn btn-dark">Force
                                            Delete</a>
                                    @else
                                        <a href="{{ route('product.destroy', $product) }}"
                                            class="btn btn-danger">Delete</a>
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
    </div>
@endsection
