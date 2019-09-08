@extends('layouts.admin')

@section('content')
    <div class="row">
    @foreach($projections as $projection)
            <div class="card" style="width: 18rem;">
                <img src="{{asset('images').'/'.$projection->movie_image}}"
                     class="card-img-top" alt="..." style="height: 450px">
                <div class="card-body">
                    <h3 class="card-title">{{$projection->movie_name}}</h3>
                    <h5 class="card-title">{{$projection->hall_number}}</h5>
                    <p class="card-text">
                        <b>Trajanje: </b>{{$projection->duration}} <br>
                        <b>Početak: </b>{{$projection->start_date}}
                    </p>
                    <a href="{{route('admin.delete-projection', ['projectionId' => $projection->id])}}" class="btn btn-danger">
                        Obriši/otkaži projekciju
                    </a>
                </div>
            </div>
    @endforeach
    </div>
@endsection
