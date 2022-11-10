@extends('layout.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('scores.update', $score) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Student ID</label>
                            <input readonly type="text" name="user_code" class="form-control" value="{{ $score->user_code }}">
                        </div>
                        <div class="form-group">
                            <label>Course</label>
                            <input readonly type="text" name="course_code" class="form-control" value="{{ $score->course_code }}">
                        </div>
                        <div class="form-group">
                            <label>Point</label>
                            <input type="text" name="point" class="form-control" value="{{ $score->point }}">
                        </div>
                        <button class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
