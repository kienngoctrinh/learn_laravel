@extends('layout.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('users.update', $user) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label>Code</label>
                            <input type="text" name="code" class="form-control" value="{{ $user->code }}">
                        </div>
                        <div class="form-group mb-3">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                        </div>
                        <div class="form-group mb-3">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" value="{{ $user->email }}">
                        </div>
                        <div class="form-group mb-3">
                            <label>Birthday</label>
                            <input type="date" name="birthday" class="form-control" value="{{ $user->date }}">
                        </div>
                        <div class="form-group mb-3">
                            <label>Gender: </label>
                            <label><input type="radio" name="gender" value="Male" {{ $user->gender == 'Male' ? 'checked' : '' }}>Male</label>
                            <label><input type="radio" name="gender" value="Female" {{ $user->gender == 'Female' ? 'checked' : '' }}>Female</label>
                        </div>
                        <div class="form-group mb-3">
                            <label>Role</label>
                            <select name="role" class="form-control">
                                <option disabled selected>Choose role</option>
                                @foreach($roles as $role => $value)
                                    <option
                                            value="{{ $value }}"
                                            {{ $user->role == $value ? 'selected' : '' }}
                                    >
                                        {{ $role }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection