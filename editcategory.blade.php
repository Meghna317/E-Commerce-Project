@extends('layouts.app')

@section('content')
<div class="container-fluid bg-dark">
    <div class="row justify-content-center">
    @include('layouts.sidebar')
        <div class="col-lg-2"></div>
        <div class="col-lg-6">
            <h3 class="text-center text-white mt-3"><b>Update Category</b></h3>
            <div class="form-group">
                <form action="{{ route('admin.update', $categories->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method("put")
                    <label class="text-white m-2">Name</label>
                    <input id="name" type="text" name="name" class="form-control m-2 @error('name') is-invalid @enderror" placeholder="Category Name" value="{{ $categories->name }}">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label class="text-white m-2">Thumbnail</label>
                    <input type="file" id="input-file-now-custom-3" class="form-control m-2 @error('thumbnail') is-invalid @enderror" name="thumbnail">
                    @error('thumbnail')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <img src="{{ asset('category/'.$categories->thumbnail) }}" class="img-responsive mt-3" style="max-height: 150px; max-width: 150px;" alt="">
                    <br>
                    <button type="submit" class="btn btn-danger mt-3">Submit</button>
                </form>
            </div>
        </div>
    </div>
    </div>    
@endsection
