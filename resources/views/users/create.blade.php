@extends('layout.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label>Code</label>
                            <input type="text" name="code" class="form-control" value="{{ old('code') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="password">Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" name="password" id="password" class="form-control">
                                <div class="input-group-append" data-password="false">
                                    <div class="input-group-text">
                                        <span class="password-eye"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label>Birthday</label>
                            <input type="date" name="birthday" class="form-control" value="{{ old('birthday') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label>Gender: </label>
                            <label><input type="radio" name="gender" value="Male" checked @if(old('gender') == 'Male') checked @endif>Male</label>
                            <label><input type="radio" name="gender" value="Female" @if(old('gender') == 'Female') checked @endif>Female</label>
                        </div>
                        <div class="form-group mb-3">
                            <label>Role</label>
                            <select name="role" class="form-control">
                                <option disabled selected>Choose role</option>
                                @foreach($roles as $role => $value)
                                    <option
                                            value="{{ $value }}"
                                            @if(old('role') == $value)
                                                selected
                                            @endif
                                    >
                                        {{ $role }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="example-fileinput">Avatar</label>
                            <input type="file" name="avatar" id="example-fileinput" class="form-control-file">
                        </div>
                        <button class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
