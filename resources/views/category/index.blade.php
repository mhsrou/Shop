@extends('product.main')
@section('content')
@push('css')
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/slider.css" rel="stylesheet" />
@endpush
    @include('product.header')

    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @forelse ($categories as $category)
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Sale badge-->
                            <a class="link-dark" href="{{ route('category.show', $category) }}">
                                <!-- Product image-->
                                <img class="card-img-top" src="{{ asset('storage/products/' . $category->image) }}" />
                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-bolder">{{ $category->name }}</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
