@extends('layouts.app')
   
@section('content')
<div class="container-fluid bg-dark">
    <div class="row justify-content-center">
    @include('layouts.sidebar')
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    You are Admin.
                </div>
            </div>
        </div>
    </div>
</div>           
@endsection