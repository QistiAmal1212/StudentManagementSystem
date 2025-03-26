<?php

namespace App\Http\Controllers;


use App\Models\Classroom;
use App\Models\Classroom_teacher;
use App\Models\students;
use Illuminate\Http\Request;

class RestApi extends Controller
{
    public function StudentData()
    {
        $students=students::all();
        return response()->json($students);
    }

    public function TeacherData()
    {
        $teachers=Classroom_teacher::all();
        return response()->json($teachers);
    }

    public function ClassroomData()
    {
        $Classroom=Classroom::all();
        return response()->json($Classroom);
    }

}
