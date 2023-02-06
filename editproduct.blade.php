@extends('layouts.app')

@section('content')
<div class="container-fluid bg-dark">
    <div class="row justify-content-center">
    @include('layouts.sidebar')
        <div class="col-lg-2"></div>
        <div class="col-lg-6">
            <h3 class="text-center text-white mt-3"><b>Update Product</b></h3>
            <div class="form-group">
                <form action="{{ route('admin.updateproduct', $products->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method("put")
                    <label class="text-white m-2">Name</label>
                    <input id="name" type="text" name="name" class="form-control m-2 @error('name') is-invalid @enderror" placeholder="Product Name" value="{{ $products->name }}">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label class="text-white m-2">Price</label>
                    <input id="price" type="text" name="price" class="form-control m-2 @error('price') is-invalid @enderror" placeholder="Product Price" value="{{ $products->price }}">
                    @error('price')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label class="text-white m-2">Sku</label>
                    <input id="sku" type="text" name="sku" class="form-control m-2 @error('sku') is-invalid @enderror" placeholder="Product Sku" value="{{ $products->sku }}">
                    @error('sku')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label class="text-white m-2">Category</label>
                    <select name="category_id" class="form-control m-2 @error('category_id') is-invalid @enderror">
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{$products->category_id == $category->id  ? 'selected' : ''}}>{{ $category->name}}</option>
                    @endforeach
                    </select>
                    @error('category_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label class="text-white m-2">Thumbnail</label>
                    <input type="file" id="thumbnail" class="form-control m-2 @error('thumbnail') is-invalid @enderror" name="thumbnails[]" multiple>
                    @error('thumbnail')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    @if(count($products->thumbnails)>0)
                        @foreach ($products->thumbnails as $thumb)
                    <img src="/thumbnails/{{ $thumb->thumbnail }}" class="img-responsive" style="max-height: 120px; max-width: 120px;" alt="">
                    @endforeach
                    @endif
                    <br>
                    <label class="text-white m-2">Description</label>
                    <textarea class="form-control m-2 @error('description') is-invalid @enderror" name="description" rows="5">{{ $products->description}}</textarea>
                    @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror 
                    <br>
                    <button type="submit" class="btn btn-danger mt-3">Submit</button>
                </form>
            </div>
        </div>
    </div>
    </div>    
@endsection
