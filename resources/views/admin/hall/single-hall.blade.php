@extends('layouts.admin')

@section('content')
    <form method="post" action="{{route('admin.update-hall', ['hallId' => $hall->id])}}">
        @csrf
        <div class="form-group">
            <label for="hallNumber">Broj dvorane</label>
            <input class="form-control" type="text" id="hallNumber" name="hall_number" value="{{$hall->hall_number}}">
        </div>
        <div class="form-group">
            <label for="seatNumber">Broj mjesta</label>
            <input type="number" class="form-control" id="seatNumber" name="seat_number" value="{{$hall->seats->count()}}">
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Opis dvorane</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="hall_description">
                {{$hall->hall_description}}
            </textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
