<?php

namespace BEN\Http\Controllers\Admin;

use Illuminate\Http\Request;
use BEN\Models\ClassInformation;
use BEN\Http\Controllers\Controller;

class ClassStudentsController extends Controller
{
   
    public function index(ClassInformation $class_information)
    {
        return view('admin.class_informations.class_student', compact('class_information'));
    }


    
    public function store(Request $request)
    {
        //
    }

   
    public function destroy($id)
    {
        //
    }
}
