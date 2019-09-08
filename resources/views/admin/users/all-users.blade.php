@extends('layouts.admin')

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Ime</th>
            <th scope="col">Email adresa</th>
            <th scope="col">Tip korisnika</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <th scope="row">{{$user->id}}</th>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>
                    <form method="post" action="{{route('admin.role-change', ['userId' => $user->id])}}">
                        @csrf
                        <div class="row">
                            <select class="form-control col-md-6" id="roleChange" name="role_id">
                                @foreach($roles as $role)
                                    <option value="{{$role->id}}"
                                            @if($role->id === $user->role_id)
                                            selected
                                        @endif
                                    >
                                        {{$role->role_name}}
                                    </option>
                                @endforeach
                            </select>

                            <button type="submit" class="btn btn-primary offset-3 col-md-3">Promjeni</button>
                        </div>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
