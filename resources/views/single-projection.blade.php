@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        @if(Auth()->check())
            <div class="col-md-10">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Broj stolice</th>
                        <th scope="col">Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($projectionSeats as $projectionSeat)
                        <tr>
                            <th scope="row">{{$projectionSeat->id}}</th>
                            <td>{{$projectionSeat->seat_number}}</td>
                            <td>
                                @if($projectionSeat->avaliable === 1)
                                    <a href="{{route('reserve-seat', ['projectionSeatId' => $projectionSeat->id])}}"
                                       class="btn btn-success">
                                        Rezerviraj
                                    </a>
                                @else
                                    <button type="button" class="btn btn-danger disabled" disabled>
                                        Zauzeto
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 class="display-4">Moraš biti prijavljen da bi rezervirao</h1>
                </div>
            </div>
        @endif
    </div>
@endsection
