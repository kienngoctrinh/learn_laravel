<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Score;
use Illuminate\Http\Request;

class ApiScoreController extends Controller
{
    public function index()
    {
        $data = Score::query()->get();

        return $data;
    }
}
