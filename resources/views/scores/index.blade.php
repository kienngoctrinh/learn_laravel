@extends('layout.master')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="app-search dropdown d-none d-lg-block">
                <form class="float-right">
                    <div class="input-group">
                        <input type="search" name="q" value="{{ $search }}" class="form-control dropdown-toggle" placeholder="Search..." id="top-search">
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
                    <th>Email</th>
                    <th>Name</th>
                    <th>Course</th>
                    <th>Point</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($scores as $score)
                        <tr>
                            <td>{{ $score->user->code }}</td>
                            <td>{{ $score->user->email }}</td>
                            <td>{{ $score->user->name }}</td>
                            <td>{{ $score->course->name }}</td>
                            <td>{{ $score->point }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection