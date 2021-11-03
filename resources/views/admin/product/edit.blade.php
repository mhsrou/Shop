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
        </div>

        <div class="container">
            <div class="p-4">
                <div class="mb-6 space-y-6">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div>
                                <label>{{ $error }}</label>
                            </div>
                        @endforeach
                    @endif
                </div>
                <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="gap-3">
                        <div class="p-2">
                            <label class="label" for="status">
                                <span class="label-text">Status</span>
                            </label>
                            <select name="status" class="form-control select w-full" required>
                                <option value="draft"
                                        @if($product->status == 'draft') slected="selected" @endif>Draft
                                </option>
                                <option value="published"
                                        @if($product->status == 'available') slected="selected" @endif>Available
                                </option>
                                <option value="published"
                                        @if($product->status == 'soon') slected="selected" @endif>Soon
                                </option>
                                <option value="published"
                                        @if($product->status == 'running_out') slected="selected" @endif>Running Out
                                </option>
                            </select>
                        </div>

                        <div class="p-2">
                            <label class="label" for="category_id">
                                <span class="label-text">Categories</span>
                            </label>
                            <select name="category_id[]" id="category_id" class="form-select">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                            @if($product->category_id == $category->id) slected="selected" @endif>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="p-2">
                            <label class="label" for="name">
                                <span class="label-text">Name</span>
                            </label>
                            <input type="text" id="name" name="name" placeholder="Name" class="form-control"
                                   required
                                   value="{{ old('name', $product->name) }}"/>
                        </div>

                        <div class="p-2">
                            <label class="label" for="desc">
                                <span class="label-text">Description</span>
                            </label>
                            <textarea name="desc" id="desc" class="ckeditor form-control" placeholder="Text"
                                      rows="8"
                                      required>{{ old('content', $product->desc) }}</textarea>
                        </div>

                        <div class="p-3 bg-white bg-gradient">
                            <label class="label" for="variation">
                                <span class="label-text">Variation</span>
                            </label>
                            <livewire:variations :product="$product"/>
                        </div>

                        <div class="d-flex flex-row bd-highlight p-2">
                            <div class="pr-5">
                                <label class="label">Primary image :
                                    <input type="file" name="image" class="form-control"/>
                                </label>
                            </div>
                            <div>
                                <label class="label">Gallery images :
                                    <input type="file" name="gallery[]" class="form-control" multiple/>
                                </label>
                            </div>
                        </div>

                        <div class="p-2">
                            <label class="label" for="discount">
                                <span class="label-text">Discount</span>
                            </label>
                            <input type="number" id="discount" name="discount" class="form-control" min="0"
                                   max="100" placeholder="discount" class="input input-bordered"
                                   required value="{{old('discount', $product->discount)}}"/>
                        </div>

                        <div class="d-grid p-2">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
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
