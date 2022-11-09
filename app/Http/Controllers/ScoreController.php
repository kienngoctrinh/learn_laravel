<?php

namespace App\Http\Controllers;

use App\Enums\UserRoleEnum;
use App\Models\Course;
use App\Models\Score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class ScoreController extends Controller
{
    private object $model;

    public function __construct()
    {
        $this->model = Score::query();

        $routeName = Route::currentRouteName();
        $arr       = explode('.', $routeName);
        $arr       = array_map('ucwords', $arr);
        $title     = implode(' - ', $arr);

        $roles = UserRoleEnum::getArrayView();

        View::share('title', $title);
        View::share('roles', $roles);
    }

    public function index(Request $request)
    {
        $search = $request->get('q');

        // $scores = $this->model
        //     ->crossJoin('users', 'users.code', '=', 'scores.user_code')
        //     ->crossJoin('courses', 'courses.code', '=', 'scores.course_code')
        //     ->where('users.email', 'like', '%' . $search . '%')
        //     ->orWhere('users.id', $search)
        //     ->orWhere('courses.name', 'like', '%' . $search . '%')
        //     ->get([
        //         'users.id as user_id',
        //         'users.email as user_email',
        //         'users.name as user_name',
        //         'courses.name as course_name',
        //         'scores.point',
        //         ]);
        //
        // return view('scores.index', [
        //     'scores' => $scores,
        //     'search' => $search,
        // ]);

        $scores = $this->model
            ->with('user')
            ->with('course')
            ->get();

        return view('scores.index', [
            'scores' => $scores,
            'search' => $search,
        ]);
    }

    public function create()
    {
        $courses = Course::query()
            ->get();

        return view('scores.create', [
            'courses' => $courses,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreScoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreScoreRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function show(Score $score)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function edit(Score $score)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateScoreRequest  $request
     * @param  \App\Models\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateScoreRequest $request, Score $score)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function destroy(Score $score)
    {
        //
    }
}
