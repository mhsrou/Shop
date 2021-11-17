@extends('product.main')
@section('content')
    @push('css')
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet"/>
        <link href="{{ asset('css/slider.css') }}" rel="stylesheet"/>
    @endpush
    @include('product.header')

    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <!-- incredible slider-->
            <div class="p-5 mb-5" style="background-color: #dc3545">
                <h2 style="color:white !important">
                    Incredibles :
                </h2>
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($incredibleProducts as $incredibleProduct)
                            @if ($loop->iteration % 3 == 1)
                                <div class="carousel-item @if ($loop->first)active @endif">
                                    <div class="cards-wrapper">
                                        @endif
                                        <div class="card @if ($loop->iteration % 3 != 1) d-none d-md-block @endif">
                                            <div class="badge bg-info text-white position-absolute m-1">
                                                {{ $incredibleProduct->discount }}%
                                            </div>
                                            <img
                                                src="{{ \Illuminate\Support\Facades\Storage::url($incredibleProduct->images[0]->url) }}"
                                                class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $incredibleProduct->name }}</h5>

                                                <p class="card-text">
                                        <span
                                            class="text-muted text-decoration-line-through">{{ number_format($incredibleProduct->price) }}</span>
                                                    {{ number_format($incredibleProduct->price * (100 - $incredibleProduct->discount)/100) }}
                                                </p>
                                                <a href="{{ route('show', $incredibleProduct) }}"
                                                   class="btn btn-primary">More...</a>
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
                    @livewire('single-product',['product' => $product])
                @endforeach
            </div>
            <div class="m-4 justify-content-center">
                {{ $products->links() }}
            </div>
        </div>
    </section>

@endsection
