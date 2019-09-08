@extends('layouts.admin')

@section('content')
    <div class="col-md-6">
        <img class="card-img-top" src="{{asset('images').'/'.$movie->movie_image}}" alt="Card image cap">
        <form method="post" action="{{route('admin.update-movie', ['movieId' => $movie->id])}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="movieName">Ime filma</label>
                <input type="text" class="form-control" name="movie_name" id="movieName" value="{{$movie->movie_name}}">
            </div>

            <div class="form-group">
                <label for="duration">Trajanje filma (u minutama)</label>
                <input type="number" class="form-control" name="duration" id="duration" value="{{$movie->duration}}">
            </div>

            <div class="form-group">
                <label for="releaseYear">Godina izlaska</label>
                <input type="number" class="form-control" name="release_year" id="releaseYear" value="{{$movie->release_year}}">
            </div>

            <div class="form-group">
                <label for="exampleFormControlFile1">Slika filma</label>
                <input type="file" class="form-control-file" id="exampleFormControlFile1" name="movie_image">
            </div>

            <div class="form-group">
                <label for="description">Opis filma:</label>
                <textarea class="form-control" rows="5" id="description" name="movie_description">{{$movie->movie_description}}</textarea>
            </div>

            <button class="btn btn-primary" type="submit">Spremi</button>
        </form>
    </div>
@endsection
