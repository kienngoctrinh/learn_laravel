@extends('layout.master')
@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('users.create') }}" class="btn btn-success">
                Create
            </a>
        </div>
        <div class="card-body">
            <table class="table table-striped table-centered mb-0">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Birthday</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->code }}</td>
                        <td class="table-user">
                            <img src="{{ $user->avatar }}" alt="table-user" class="mr-2 rounded-circle">
                            {{ $user->name }}
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->date }}</td>
                        <td>{{ $user->age }}</td>
                        <td>{{ $user->gender }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->updated_at }}</td>
                        <td>
                            <a href="{{ route('users.edit', $user) }}" class="action-icon"><i class="mdi mdi-pencil"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection