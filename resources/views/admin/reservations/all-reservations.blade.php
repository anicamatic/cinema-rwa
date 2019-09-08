@extends('layouts.admin')

@section('content')
    <div class="col-md-6">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Broj dvorane</th>
                <th scope="col">Ime filma</th>
                <th scope="col">Ime korisnika</th>
                <th scope="col">Email korisnika</th>
                <th scope="col">Akcije</th>
            </tr>
            </thead>
            <tbody>
            @foreach($reservations as $reservation)
                <tr>
                    <th scope="row">1</th>
                    <td>{{$reservation->hall_number}}</td>
                    <td>{{$reservation->movie_name}}</td>
                    <td>{{$reservation->name}}</td>
                    <td>{{$reservation->email}}</td>
                    <td>
                        <a href="{{route('admin.delete-reservation', ['reservationSeatId' => $reservation->id])}}" class="btn btn-danger">
                            Poništi rezervaciju
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
