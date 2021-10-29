@extends('product.main')

@push('css')
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
@endpush

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
    <!-- Product section-->
    @livewire('show',['product' => $product])
    <!-- Related items section-->
    @include('product.related')
@endsection
