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
        @foreach($products as $product)
            @if (!$product->deleted_at)
                <a href="{{ route('admin.product.deleted') }}" class="btn btn-outline-primary btn-sm mb-5">Deleted
                    Products</a>
            @else
                <a href={{route('admin.product.index')}} class="btn btn-outline-primary btn-sm mb-5">Go back</a>
            @endif
            @break
        @endforeach
        <div class="row">
            <div class="col-lg-8">
                @forelse ($products as $product)
                    @if (!$product->deleted_at)
                        <div class="mb-4 alert alert-danger my-2 border -danger" >
                            <div style="display:inline-block">
                                <a href="#!">
                                    <figure>
                                        <img class="img-thumbnail"
                                             src="{{ asset('storage/images/' . $product->image) }}"
                                             alt="Trulli"
                                             style="width:100%">
                                        <figcaption>
                                            <p class="small text-muted">{{ $product->price }}</p>
                                            <h2 class="card-title">{{ $product->name }}</h2>
                                            <p class="card-text">{{ Str::limit($product->description, 20) }}</p>
                                            <a href="{{ route('admin.product.show', $product) }}">read more...</a>
                                        </figcaption>
                                    </figure>
                                </a>
                                {{--                            <div class="card-body">--}}

                                {{--                            </div>--}}
                            </div>
                        </div>
                    @else
                        <div class="mb-4 my-2 border border -black">
                            <a href="#!"><img class="img-thumbnail"
                                              src="{{ asset('storage/images/' . $product->image) }}"
                                              width="250px" height="250px"></a>
                            <div class="card-body">
                                <div class="small text-muted">{{ $product->price }}</div>
                                <h2 class="card-title">{{ $product->name }}</h2>
                                <p class="card-text">{{ Str::limit($product->description, 20) }}</p>
                                <a href="{{ route('admin.product.show', $product) }}">read more...</a>
                            </div>
                        </div>
                    @endif
                    <hr>
                @empty
                    <div class="alert alert-success" role="alert">
                        <h4 class="alert-heading">Nothing here</h4>
                    </div>
                @endforelse
                <div class="d-flex justify-content-center">
                    {!! $products->links() !!}
                </div>
            </div>
        </div>
    </div>
    <script src="js/scripts.js"></script>
@endsection
