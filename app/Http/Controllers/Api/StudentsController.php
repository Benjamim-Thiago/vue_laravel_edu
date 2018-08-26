<?php

namespace BEN\Http\Controllers\Api;

use BEN\Models\Student;
use Illuminate\Http\Request;
use BEN\Http\Controllers\Controller;

class StudentsController extends Controller
{
    public function index()
    {
        return Student::all();
    }
}
