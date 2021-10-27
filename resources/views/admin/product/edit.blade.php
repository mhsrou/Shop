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
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <form action="{{ route('product.update') }}" method="post">
            @csrf
            @method('patch')

            <div class="p-10 card bg-base-200">
                <div class="form-control">
                    <label class="label" for="name">
                        <span class="label-text">Name</span>
                    </label>
                    <input type="text" id="title" name="title" placeholder="Title" class="input input-bordered" required
                        value="{{ old('name', $product->name) }}">
                </div>
                <div class="form-control mb-8">
                    <label class="label" for="content">
                        <span class="label-text">Text</span>
                    </label>
                    <textarea name="content" id="content" class="textarea input-bordered" placeholder="Text" rows="8"
                        required>{{ old('desc', $product->desc) }}"</textarea>
                </div>
                <button type="submit" class="btn btn-lg w-full">Update</button>
            </div>
        </form>
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
