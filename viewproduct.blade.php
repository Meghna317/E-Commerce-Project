@extends('layouts.app')

@section('content')
<!-- <div class="container custom-product">


    <div id="myCarousel" class="carousel slide" data-ride="carousel"> -->
        <!-- Indicators -->
        <!-- <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol> -->

        <!-- Wrapper for slides -->
        <!-- <div class="carousel-inner">
        @foreach($products as $item)
        <div class="item {{$item['id']==1?'active':''}}">
        <img class="slider-img" src="/thumbnails/{{$item['thumbnail']}}">
            <div class="carousel-caption">
                <h3>{{$item['name']}}</h3>
                <p>{{$item['description']}}</p>
            </div>
        </div>
        @endforeach
        </div> -->

        <!-- Left and right controls -->
        <!-- <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
       

</div>     -->

<div class="d-flex justify-content-center p-2 m-2">
        <div class="card p-2 w-50">
            <div class="d-flex justify-content-between">
                <div class="">
                    <h3 class="text-center">Product List</h3>
                </div>
               
            </div>
            <hr class="my-1">
            <div class="row">
                @foreach ($products as $product)
                <div class="col-3 mt-4">
                    <div class="card">
                        <a href="productdetail/{{$product['id']}}"><img src="/thumbnails/{{ $product->thumbnails()->first()->thumbnail }}" height="150">
                    </div>
                    <h6><u>{{ $product->name }}</u></h6>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection