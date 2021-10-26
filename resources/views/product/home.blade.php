@extends('product.main')
@section('content')

    @include('product.header')

    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <!-- incredible slider-->
            <div class="p-5 mb-5" style="background-color: red ">
                <h2 style="color:white !important">
                    Incredibles :
                </h2>
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($products as $product)

                            @if ($loop->iteration % 3 == 1)
                                <div class="carousel-item @if ($loop->first)active @endif">
                                    <div class="cards-wrapper">
                            @endif
                            <div class="card @if ($loop->iteration % 3 != 1) d-none d-md-block @endif">
                                <div class="badge bg-info text-white position-absolute m-1">{{ $product->discount }}%
                                </div>
                                <img src="{{ asset('storage/images/' . $product->image) }}" class="card-img-top"
                                    alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>

                                    <p class="card-text">
                                        <span class="text-muted text-decoration-line-through">{{ $product->price }}</span>
                                        {{ $product->price * (100 - $product->discount) }}
                                    </p>
                                    <a href="{{ route('product.show', $product) }}" class="btn btn-primary">More...</a>
                                </div>
                            </div>
                            @if ($loop->iteration % 3 == 0 || $loop->last)
                    </div>
                </div>
                @endif

                @endforeach
            </div>

            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
                <span aria-hidden="true"></span>
                <span class="sr-only"><i class="bi bi-chevron-double-left"></i></span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
                <span aria-hidden="true"></span>
                <span class="sr-only"><i class="bi bi-chevron-double-right"></i></span>
            </a>
        </div>
        </div>
        <!-- incredible slider-->

        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

            @foreach ($products as $product)
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Sale badge-->
                        <div class="badge bg-red text-white position-absolute">{{ $product->discount }}%
                        </div>
                        <!-- Product image-->
                        <a class="link-dark" href="{{ route('product.show', $product) }}">
                            <!-- Product image-->
                            <img class="card-img-top" src="{{ asset('storage/images/' . $product->image) }}" />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">{{ $product->name }}</h5>
                        </a>
                        <!-- Product reviews-->
                        <div class="d-flex justify-content-center small text-warning mb-2">
                            <div class="bi-star-fill"></div>
                            <div class="bi-star-fill"></div>
                            <div class="bi-star-fill"></div>
                            <div class="bi-star-fill"></div>
                            <div class="bi-star-fill"></div>
                        </div>
                        <!-- Product price-->
                        <span class="text-muted text-decoration-line-through">{{ $product->price }}</span>
                        {{ $product->price * (100 - $product->discount) }}
                    </div>
                </div>
                <!-- Product actions-->
                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                </div>
        </div>
        </div>
        @endforeach
        </div>
        </div>
    </section>

@endsection
