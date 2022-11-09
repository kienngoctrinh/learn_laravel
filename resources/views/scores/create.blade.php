@extends('layout.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('scores.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Student ID</label>
                            <input type="text" name="user_code" class="form-control" value="{{ old('user_code') }}">
                        </div>
                        <div class="form-group">
                            <label>Course</label>
                            <select name="course_code" class="form-control">
                                @foreach($courses as $course)
                                    <option hidden>Choose course</option>
                                    <option value="{{ $course->code }}" {{ old('course_code') == $course->code ? 'selected' : '' }}>
                                        {{ $course->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Point</label>
                            <input type="text" name="point" class="form-control" value="{{ old('point') }}">
                        </div>
                        <button class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
