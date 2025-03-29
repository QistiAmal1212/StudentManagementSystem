<?php

namespace App\Http\Controllers;


use App\Models\Classroom;
use App\Models\ClassroomTeacher;
use App\Models\Students;
use Illuminate\Http\Request;

class RestApi extends Controller
{
    public function StudentData()
    {
        $students=Students::all();
        return response()->json($students);
    }

    public function TeacherData()
    {
        $teachers=ClassroomTeacher::all();
        return response()->json($teachers);
    }

    public function classroomData()
    {
        $classroom=Classroom::all();
        return response()->json($classroom);
    }

}
