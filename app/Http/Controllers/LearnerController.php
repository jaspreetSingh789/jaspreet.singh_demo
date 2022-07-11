<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LearnerController extends Controller
{
    public function index()
    {

        return view('learner.index');
    }
}
