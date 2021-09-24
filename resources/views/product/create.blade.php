@extends('layouts.app')
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
@endif
<div class="container">
    <div class="row">
        <div class="col-12 pt-2">
            <a href="/products" class="btn btn-outline-primary btn-sm">Go back</a>
            <div class="border rounded mt-5 pl-4 pr-4 pt-4 pb-4">
                <h2 class="display-4">Create a New Product Post</h2>
                <p>Fill and submit for a new product</p>

                <hr>

                <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="user_id" value="{{Auth::id()}}">
                    @csrf
                    <div class="row">
                        <div class="control-group col-12">
                            <label for="name">Name title</label>
                            <input type="text" id="name" class="form-control" name="name" required>
                        </div>
                        <div class="control-group col-12 mt-2">
                            <label for="description">Description</label>
                            <textarea id="description" class="ckeditor form-control" name="description"
                                      placeholder="Enter Description" rows="" required></textarea>
                        </div>
                        <div class="control-group col-12 mt-2">
                            <label for="image">Image Upload</label>
                            <input type="file" name="image" id="image">
                        </div>
                        <div class="control-group col-12 mt-2">
                            <label for="price">Price</label>
                            <input type="number" name="price" id="image" placeholder="Enter Price" required>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="control-group col-12 text-center">
                            <button id="btn-submit" class="btn btn-primary">
                                Create
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
        $(document).ready(function() {
            $('.ckeditor').ckeditor();
        });
    </script>
@endsection
