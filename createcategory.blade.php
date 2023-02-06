@extends('layouts.app')

@section('content')

<div class="container-fluid bg-dark">
    <div class="row justify-content-center">
    @include('layouts.sidebar')
        <div class="col-lg-2"></div>
        <div class="col-lg-6">
            <h3 class="text-center text-white mt-3"><b>Add New Category</b></h3>
            <div class="form-group">
                <form action="{{route('admin.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <label class="text-white m-2">Name</label>
                    <input id="name" type="text" name="name" class="form-control m-2 @error('name') is-invalid @enderror" placeholder="Category Name">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label class="text-white m-2">Thumbnail</label>
                    <input type="file" id="thumbnail" class="form-control m-2 @error('thumbnail') is-invalid @enderror" name="thumbnail">
                    @error('thumbnail')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <button type="submit" class="btn btn-danger mt-3">Submit</button>
                </form>
            </div>
        </div>
    </div>
    </div>    
    </div>
@endsection
