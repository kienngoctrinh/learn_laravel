@extends('layout.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('users.store') }}" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label>Birthday</label>
                            <input type="date" name="birthday" class="form-control" value="{{ old('birthday') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label>Gender: </label>
                            <label><input type="radio" name="gender" value="1" checked @if(old('gender') == '1') checked @endif>Male</label>
                            <label><input type="radio" name="gender" value="0" @if(old('gender') == '0') checked @endif>Female</label>
                        </div>
                        <div class="form-group mb-3">
                            <label>Programming Language</label>
                            <input type="text" name="programming_language" class="form-control" value="{{ old('programming_language') }}">
                        </div>
                        <button class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection