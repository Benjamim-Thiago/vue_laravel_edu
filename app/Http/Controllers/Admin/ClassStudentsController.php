<?php

namespace BEN\Http\Controllers\Admin;

use Illuminate\Http\Request;
use BEN\Models\ClassInformation;
use BEN\Http\Controllers\Controller;

class ClassStudentsController extends Controller
{
   
    public function index(Request $request, ClassInformation $class_information)
    {
        if(!$request->ajax()){
            return view('admin.class_informations.class_student', compact('class_information'));
        }
        return $class_information->students()->get();
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
