@extends('layouts.app')

@section('content')
<div class="container-fluid bg-dark">
    <div class="row justify-content-center">
    @include('layouts.sidebar')
    <div class="col-md-8">
    <div class="card">
        <div class="card-header">
      
            <h3 class="card-title text-center"><b>Category {{ $categories->name }}</b></h3>
         
        </div>
            <table class="table table-bordered table-striped text-center mt-3">
        <thread>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Sku</th>
                <th>Thumbnail</th>
                <th>Update</th>
                <th>Delete</th>
                
            </tr>
        </thread>
        <tbody>
            @foreach($products as $product)
            <tr>
                <th scope="row">{{ $product->id }}</th>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->sku }}</td>
                    <td>
                       <img src="/thumbnails/{{ $product->thumbnails()->first()->thumbnail }}" class="img-responsive" style="max-height: 120px; max-width: 120px;" alt="">
                    </td>
                    <td><a href="{{ route('admin.editproduct', $product->id) }}" class="btn btn-outline-primary">Update</a></td>
                    <td>
                        <form action="{{ route('admin.deleteproduct', $product->id) }}" method="post">
                        <button class="btn btn-outline-danger" onclick="return confirm('Are you sure?')" type="submit">Delete</button>
                        @csrf
                        @method('delete')
                        </form>
                    </td>
            </tr>
            @endforeach
        </tbody>
    </table>
            </div>
        </div>
    </div>
    </div>    
@endsection
