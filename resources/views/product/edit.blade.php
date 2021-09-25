@extends('layouts.app')
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
    @if (session('message'))
        <div>
            <ul>
                {{ session('message') }}
            </ul>
        </div>
    @endif
    <div class="container bg-white">
        <div class="row">
            <div class="col-12 pt-2">
                <a href="/product" class="btn btn-outline-primary btn-sm">Go back</a>
                <div class="border rounded mt-5 pl-4 pr-4 pt-4 pb-4">
                    <h1 class="display-4">Edit product</h1>
                    <hr>
                    <form action="{{ route('product.update', $product) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                        @csrf
                        <div class="row">
                            <div class="control-group col-12">
                                <label for="name">Name title</label>
                                <input type="text" id="name" class="form-control" name="name"
                                       placeholder="Enter Post name" value="{{ $product->name }}" required>
                            </div>
                            <div class="control-group col-12 mt-2">
                                <label for="desc">Description</label>
                                <textarea id="desc" class="ckeditor form-control" name="desc"
                                          placeholder="Enter desc" rows=""
                                          required> {{ $product->desc }} </textarea>
                            </div>
                            <div class="control-group col-12 mt-2">
                                <img class="img-thumbnail" src="{{ asset('images/' . $product->image) }}">
                            </div>
                            <div class="control-group col-12 mt-2">
                                <label for="image">Image Upload</label>
                                <input type="file" name="image" id="image" placeholder="Enter Post Body">
                            </div>
                            <div class="control-group col-12 mt-2">
                                <label for="price">Price</label>
                                <input type="number" name="price" id="price"
                                       value={{ $product->price }} class="form-control" placeholder="Enter Price">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="control-group col-12 text-center">
                                <button id="btn-submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('editor')
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.ckeditor').ckeditor();
        });
    </script>
@endsection
