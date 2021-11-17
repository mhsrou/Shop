@extends('layouts.app')
@include('product.nav')
@push('css')
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
@endpush
@section('content')


    <main class="container align-text-top p-5">

        <table class="table table-hover text-center">
            <caption>{{auth()->user()->name.'`s cart'}}</caption>
            <thead class="table-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Product Name</th>
                <th scope="col">Count</th>
                <th scope="col">Price</th>
                <th scope="col">Total Price</th>
            </tr>
            </thead>
            @foreach($my_card as $key => $value)
                @if($key === array_key_last($my_card)) @break @endif
                <tr>
                    <th>{{ $loop->iteration }}</th>
                    <td>{{ $value['variation']['name'] }}</td>
                    <td>{{ $value['count'] }}</td>
                    <td>{{ $value['variation']['price'] }}</td>
                    <td>{{ $value['total_price'] }}</td>
                </tr>
            @endforeach
            <tfoot>
            <tr>
                <th></th>
                <td></td>
                <td>{{ end($my_card)['total_count'] }}</td>
                <td></td>
                <td class="table-info">{{ end($my_card)['total_payment'] }}</td>
            </tr>
            </tfoot>
        </table>
        <a href="{{route('purchase',end($my_card))}}" class="btn btn-primary">Purchase</a>
    </main>

@endsection
