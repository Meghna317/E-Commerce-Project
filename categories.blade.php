@extends('layouts.app')

@section('content')

<div class="container-fluid bg-dark">
    <div class="row justify-content-center">
    @include('layouts.sidebar')
    <div class="col-md-8">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-center"><b>Category Details Page</b></h3>
        </div>
        <a href="{{route('admin.createcategory')}}" style="max-width: 150px; float:right; display:block;" class="btn btn-clock btn-success mt-3">Add New Category</a>

    <table class="table table-bordered table-striped text-center mt-3">
        <thread>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Thumbnail</th>
                <th>Show</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
        </thread>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <th scope="row">{{ $category->id }}</th>
                    <td>{{ $category->name }}</td>
                    <td><img src="{{ asset('category/'.$category->thumbnail) }}" class="img-responsive" style="max-height:100px; max-width:150px;" alt="" srcset=""></td>
                    <td><a href="{{ route('admin.viewcategory', $category->id) }}" class="btn btn-outline-primary">Show</a></td>
                    <td><a href="{{ route('admin.edit', $category->id) }}" class="btn btn-outline-primary">Update</a></td>
                    <td>
                        <form action="{{ route('admin.delete', $category->id) }}" method="post">
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
