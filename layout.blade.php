<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/all.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Satisfy&display=swap">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <title>{{$title}}</title>
</head>
<body>
    <div class="container-fluid bg-dark">
        <div class="row">
            <div class="col-sm-2">
                @include('sidebar')
            </div>
            <div class="col-sm-10">
                {{ $content }}
            </div>
        </div>
    </div>
    
</body>
</html>