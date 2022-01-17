@extends('layouts.app')
@include('product.nav')
@push('css')
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet"/>
@endpush
@section('content')
    @if (session('update'))
        <div class="alert alert-success">
            <ul>
                {{ session('update') }}
            </ul>
        </div>
    @endif
    @if (session('successful purchase'))
        <div class="alert alert-success">
            <ul>
                {{ session('successful purchase') }}
            </ul>
        </div>
    @endif
    <div>
        <div class="container emp-profile">
            <form action="{{route('profile.edit', $user)}}" method="get">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <div class="col mb-5">
                                <div class="">
                                    <!-- Product image-->
                                    <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg"
                                         alt="..."/>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                            <h5>
                                {{$user->name}}
                            </h5>
                            <h6 class="mb-5">
                                {{ ($user->getRoleNames()[0]) ?? "customer" }}
                            </h6>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                       aria-controls="home" aria-selected="true">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                       aria-controls="profile" aria-selected="false">Purchases</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <input type="submit" value="edit profile" class="profile-edit-btn"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">

                    </div>
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Name </label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{$user->name}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Email </label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{$user->email}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Phone </label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{$user->phone}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Level </label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{$user->getRoleNames()[0] ?? "customer"}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                @foreach($purchases as $purchase)
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>{{$purchase->total_count}}</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{$purchase->total_payment}}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="col-md-2 m-5 p-3">
                <form class="mt-2" action="{{route('logout', $user)}}" method="post">
                    @csrf
                    <input type="submit" value="logout" class="profile-edit-btn"/>
                </form>
            </div>
        </div>
    </div>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
@endsection
