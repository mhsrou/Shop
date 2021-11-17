@extends('layouts.app')
@include('product.nav')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container">
        <div class="p-4">
            <form action="{{ route('profile.update',$user) }}" method="post">
                @csrf
                @method('patch')

                <div class="gap-3">
                    <div class="p-2">
                        <label class="label" for="name">
                            <span class="label-text">Name</span>
                        </label>
                        <input type="text" id="name" name="name" placeholder="Name" class="form-control"
                               required
                               value="{{ old('name', $user->name) }}"/>
                    </div>

                    <div class="p-2">
                        <label class="label" for="phone">
                            <span class="label-text">Phone number</span>
                        </label>
                        <input type="number" id="phone" name="phone"
                               placeholder="Phone number" class="input form-control"
                               required value="{{old('phone', $user->phone)}}"/>
                    </div>

                    <div class="d-grid p-2">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
