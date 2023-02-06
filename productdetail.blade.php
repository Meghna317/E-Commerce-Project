@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
    <div class="col-sm-6">
        @if(count($product->thumbnails)>0)
        @foreach ($product->thumbnails as $thumb)
            <img class="img-responsive" src="/thumbnails/{{ $thumb->thumbnail }}" style="max-height: 200px; max-width: 200px;" alt="">
        @endforeach
        @endif
    </div>
    <div class="col-sm-6">
        <h3>{{$product['name']}}</h3>
        <h4>Price: {{$product['price']}}</h4>
        <h5>Category: {{ $product->category->name }}</h5>
        <h5>Description:<h6><p>{{$product['description']}}</p></h6></h5>
        <br><br>
        {{-- <button class="btn btn-primary">Add to Cart</button> --}}
        <br><br>
    </div>
    </div>
</div>
@endsection
