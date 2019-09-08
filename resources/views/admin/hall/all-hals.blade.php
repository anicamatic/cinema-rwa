@extends('layouts.admin')

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Broj dvorane</th>
            <th scope="col">Broj mjesta</th>
            <th scope="col">Akcije</th>
        </tr>
        </thead>
        <tbody>
        @foreach($halls as $hall)
                <tr>
                    <th scope="row">{{$hall->id}}</th>
                    <th scope="row">{{$hall->hall_number}}</th>
                    <th scope="row">{{$hall->seat_number}}</th>
                    <th>
                        <a href="{{route('admin.delete-hall', ['hallId' => $hall->id])}}">
                            <i class="fas fa-trash"></i>
                        </a>
                        <a href="{{ route('admin.single-hall', ['hallId' => $hall->id]) }}">
                            <i class="fas fa-edit"></i>
                        </a>
                    </th>
                </tr>
        @endforeach
        </tbody>
    </table>
@endsection
