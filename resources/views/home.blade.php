@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="slideshow-container">

            @foreach($projections as $projection)
                <div class="mySlides fade">
                    <img src="{{asset('images').'/'.$projection->movie_image}}" style="width:100%; height:100%">
                    <div class="text">{{$projection->movie_name}} - {{$projection->start_date}}</div>
                </div>
            @endforeach

        </div>
        <br>

        <div style="text-align:center">
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
        </div>
    </div>
@endsection
