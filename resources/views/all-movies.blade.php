@extends('layouts.app')

@section('content')
    <div class="row">
        @foreach($projections as $projection)
            <a href="{{route('single-projection', ['projectionId' => $projection->id])}}"></a>
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="{{asset('images').'/'.$projection->movie_image}}"
                     style="height:450px;" alt="Card image cap">
                <div class="card-body">
                    <h3 class="card-title">{{$projection->movie_name}}</h3>
                    <h5 class="card-title">{{$projection->start_date}}</h5>
                    <p class="card-text">{{$projection->movie_description}}</p>
                    <a href="{{route('single-projection', ['projectionId' => $projection->id])}}" class="btn btn-info">
                        Rezerviraj sjedalo
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
