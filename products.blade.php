@extends('layouts.app')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<div class="container-fluid bg-dark">
    <div class="row justify-content-center">
    @include('layouts.sidebar')
    <div class="col-md-8">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-center"><b>Product Details Page</b></h3>
        </div>
        <div class="row mb-3">
            <div class="col-sm-6">
                <div class="input-group input-group-merge">
                    <a href="{{route('admin.createproduct')}}" style="max-width: 150px; float:right; display:block;" class="btn btn-clock btn-success mt-3">Add New Product</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 mt-3">
                <div class="input-group input-group-merge">
                    <input class="form-control" type="search" name="search" id="search" placeholder="Search...">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 mt-3">
                <div class="input-group input-group-merge">
                <span class="m-2">Category:</span>
                <select name="category" id="category" class="form-control m-2 @error('category_id') is-invalid @enderror">
                    {{-- <option value="select">Select Category</option> --}}
                    @if(count($categories)>0)
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                    @endif
                </select>
                @error('category_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4 mt-3">
            <div class="input-group input-group-merge">
            <span class="m-2">Sorting:</span>
            <select name="product" id="product" class="form-control m-2">
                <option value="default">Default sorting</option>
                <option value="name">Sort by name</option>
                <option value="price">Sort by price:low to high</option>
                <option value="price-desc">Sort by price:high to low</option>
                <option value="sku">Sort by sku</option>
            </select>
        </div>
    </div>
    </div>

    <table id="products-table" class="table table-bordered table-striped text-center mt-3">
        <thread>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Sku</th>
                <th>Category</th>
                <th>Thumbnail</th>
                <th>Status</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
        </thread>
        <tbody id="tbody">
        @if(count($products)>0)
            @foreach($products as $product)
            <tr>
                <th scope="row">{{ $product->id }}</th>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->sku }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>
                       <img src="/thumbnails/{{ $product->thumbnails()->first()->thumbnail }}" class="img-responsive" style="max-height: 120px; max-width: 120px;" alt="">
                    </td>
                    <!-- <td>
                        <?php if($product->status == '1'){ ?>
                            <a href="{{url('/status-update',$product->id)}}" class="btn btn-success">Active</a>
                        <?php }else{ ?>
                            <a href="{{url('/status-update',$product->id)}}" class="btn btn-danger">Inactive</a>
                      <?php } ?>
                    </td> -->
                    <td>
                        <input data-id="{{$product->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $product->status ? 'checked' : '' }}>
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
        @else
            <tr>
                <td>No products found</td>
            </tr>
        @endif
        </tbody>
    </table>
    </div>
</div>
</div>
</div>
<script>
  $(function() {
    $('.toggle-class').change(function() {
        var status = $(this).prop('checked') == true ? 1 : 0;
        var id = $(this).data('id');

        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/changeStatus',
            data: {'status': status, 'id': id},
            success: function(data){
              //console.log(data.success)
                toastr.options.closeButton = true;
                toastr.options.closeMethod = 'fadeOut';
                toastr.options.closeDuration = 100;
                toastr.options.preventDuplicates = true;
                toastr.success(data.success);
            }
        });
    })
  })
</script>

<script>
    $(document).ready(function(){
        $("#search").on('keyup',function(){
            var value = $(this).val();

        $.ajax({
            url:"{{ route('searchProducts') }}",
            type:"GET",
            data:{'search':value},
            success:function(data){
                //console.log(data);
                 $("#tbody").html(data);
            }
        });
    });
    });
</script>

<script>
    $(document).ready(function(){
        $("#category").on('change',function(){
            var category = $(this).val();

        $.ajax({
            url:"{{ route('filterProducts') }}",
            type:"GET",
            data:{'category':category},
            success:function(data){
                //console.log(data);
                 $("#tbody").html(data);
            }
        });
    });
    });
</script>

<script>
    $(document).ready(function(){
        $("#product").on('change',function(){
            var product = $(this).val();

            $.ajax({
            url:"{{ route('sortProducts') }}",
            type:"GET",
            data:{'product':product},
            success:function(data){
                //console.log(data);
             $("#tbody").html(data);
            }
        });
    });
    });
</script>

@endsection
