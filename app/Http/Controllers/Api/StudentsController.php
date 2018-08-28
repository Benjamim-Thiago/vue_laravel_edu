<?php

namespace BEN\Http\Controllers\Api;

use BEN\Models\Student;
use Illuminate\Http\Request;
use BEN\Models\ClassInformation;
use BEN\Http\Controllers\Controller;
use BEN\Http\Requests\ClassStudentRequest;

class StudentsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('q');
        return !$search ?
            [] :
            Student::whereHas('user', function ($query) use ($search){
            $query->where('users.name', 'LIKE', "%{$search}%");
            })->take(10)->get();
    }

    public function store(ClassStudentRequest $request, ClassInformation $class_information) 
    {
        $student = Student::find($request->get('student_id'));
        $class_information->students()->save($student);
        return $student;
    }
}
