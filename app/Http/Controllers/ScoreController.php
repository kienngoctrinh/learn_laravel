<?php

namespace App\Http\Controllers;

use App\Enums\UserRoleEnum;
use App\Http\Requests\Score\StoreRequest;
use App\Http\Requests\Score\UpdateRequest;
use App\Models\Course;
use App\Models\Score;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            ->whereHas('user', function ($query) use ($search) {
                $query->where('email', 'like', '%' . $search . '%')
                    ->orWhere('name', 'like', '%' . $search . '%')
                    ->orWhere('code', $search);
            })
            ->orWhereHas('course', function ($query) use ($search) {
                $query->where('name', $search);
            })
            ->orWhere('point', 'like', '%' . $search . '%')
            ->orderByDesc('point')
            ->get();

        return view('scores.index', [
            'scores' => $scores,
            'search' => $search,
        ]);
    }

    public function create()
    {
        // $users = User::query()
        //     ->whereNotIn('code', function ($query) {
        //         $query->select('user_code')
        //             ->from('scores');
        //     })
        //     ->get();

        $courses = Course::query()
            ->get()->unique('name');

        return view('scores.create', [
            'courses' => $courses,
            // 'users'   => $users,
        ]);
    }

    public function store(StoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->model->create($request->validated());

            DB::commit();

            return redirect()->route('scores.index')->with('success', 'Score created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit(Score $score)
    {
        $courses = Course::query()
            ->get()->unique('name');

        return view('scores.edit', [
            'score'   => $score,
            'courses' => $courses,
        ]);
    }

    public function update(UpdateRequest $request, $scoreId)
    {
        DB::beginTransaction();
        try {
            $score = $this->model->findOrFail($scoreId);
            $score->fill($request->validated());
            $score->save();

            DB::commit();

            return redirect()->route('scores.index')->with('success', 'Score updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($scoreId)
    {
        Score::destroy($scoreId);

        return redirect()->back()->with('success', 'Score deleted successfully.');
    }
}
