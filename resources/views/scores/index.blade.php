@extends('layout.master')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="app-search dropdown d-none d-lg-block">
                <form class="float-right">
                    <div class="input-group">
                        <input type="text" name="q" value="{{ $search }}" class="form-control dropdown-toggle"
                               placeholder="Search..." id="top-search">
                        <div class="input-group-append">
                            <button class="btn btn-primary mdi mdi-magnify search-icon" type="submit"></button>
                        </div>
                    </div>
                </form>
            </div>
            <a href="{{ route('scores.create') }}" class="btn btn-success">
                Create
            </a>
        </div>
        <div class="card-body">
            <table class="table table-striped table-centered mb-0">
                <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Course</th>
                    <th>Point</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($scores as $score)
                    <tr>
                        <td>{{ $score->user_code }}</td>
                        <td>{{ $score->user->name }}</td>
                        <td>{{ $score->user->email }}</td>
                        <td>{{ $score->course->name }}</td>
                        <td>{{ $score->point }}</td>
                        <td>{{ $score->created_at }}</td>
                        <td>{{ $score->updated_at }}</td>
                        <td class="table-action">
                            <a href="{{ route('scores.edit', $score) }}" class="action-icon"><i class="mdi mdi-pencil"></i></a>
                            <form action="{{ route('scores.destroy', $score) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="action-icon border-0"><i class="mdi mdi-delete"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                @if(count($scores) == 0)
                    <tr>
                        <td colspan="5" class="text-center">No data</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection