<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $subjects = Subject::when(auth()->user()->isTeacher(), function ($query) {
            return $query->where('user_id', auth()->id());
        })->get();
        return view('dashboard', compact('subjects'));
    }
}
