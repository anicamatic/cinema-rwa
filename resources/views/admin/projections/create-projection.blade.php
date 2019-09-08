@extends('layouts.admin')

@section('content')
    <div class="col-md-6">
        <form method="post" action="{{route('admin.create-projection')}}">
            @csrf
            <div class="form-group">
                <label for="startDate">Početak</label>
                <input type="datetime-local" name="start_date" class="form-control" id="startDate">
            </div>

            <div class="form-group">
                <label for="movieName">Film</label>
                <select class="form-control" id="movieName" name="movie_id">
                    @foreach($movies as $movie)
                        <option value="{{$movie->id}}">{{$movie->movie_name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="hallNumber">Broj dvorane</label>
                <select name="hall_id" id="hallNumber" class="form-control">
                    @foreach($halls as $hall)
                        <option value="{{$hall->id}}">{{$hall->hall_number}}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Napravi</button>
        </form>
    </div>
@endsection
