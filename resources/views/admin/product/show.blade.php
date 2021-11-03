@extends('layouts.app')
@section('content')
    @if (session('create'))
        <div class="alert alert-success">
            <ul>
                {{ session('create') }}
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
    @if (session('update'))
        <div class="alert alert-success">
            <ul>
                {{ session('update') }}
            </ul>
        </div>
    @endif
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <div class="container">
        <a href="/admin/product" class="btn btn-outline-primary btn-sm mb-5">Go back</a>
        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <a href="#!"><img class="img-thumbnail" width="450px" height="450px"
                                      src="{{ \Illuminate\Support\Facades\Storage::url($product->images[0]->url) }}"></a>
                    <div class="card-body">
                        <div class="small text-muted">{{ $product->updated_at }}</div>
                        <h2 class="card-title">{{ $product->name }}</h2>
                        <p class="card-text">{!! $product->desc !!}</p>
                        <p class="card-text">{!! $product->price !!}</p>
                        <a href="/admin/product/{{ $product->id }}/edit" class="btn btn-outline-primary">Edit Post</a>
                        <br><br>
                        @if ($product->deleted_at)
                            <form style="display:inline" method="post" action="{{ route('admin.product.forceDelete', $product) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger" type="submit">Force Delete</button>
                            </form>

                            <form style="display:inline" method="post" action="{{ route('admin.product.restore', $product) }}">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-outline-success" type="submit">Restore</button>
                            </form>
                        @else
                            <form id="delete-frm" onclick="return confirm('Are you sure delete post?')"
                                  action=" {{ route('admin.product.destroy', $product) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger">Delete Product</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
