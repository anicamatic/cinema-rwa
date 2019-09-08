@extends('layouts.admin')

@section('content')
    <div class="row">
        @foreach($movies as $movie)
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="{{asset('images').'/'.$movie->movie_image}}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{$movie->movie_name}}</h5>
                    <p class="card-text">{{$movie->movie_description}}</p>
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{route('admin.delete-movie', ['movieId' => $movie->id])}}" class="btn btn-danger">
                                Obriši film
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{route('admin.single-movie', ['movieId' => $movie->id])}}" class="btn btn-info">
                                Pojedinosti
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        @endforeach
    </div>
@endsection
