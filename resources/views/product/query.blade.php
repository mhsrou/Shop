@extends('product.main')
@section('content')
    @push('css')
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet"/>
        <link href="{{ asset('css/slider.css') }}" rel="stylesheet"/>
    @endpush
    @include('product.header')

    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach ($products as $product)
                    @livewire(
                    'single-product',['product' => $product])
                @endforeach
                <div class="m-4">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </section>

@endsection
