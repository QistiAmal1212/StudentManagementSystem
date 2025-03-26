<?php

namespace App\Http\Controllers;


use App\Models\classroom;
use App\Models\classroom_teacher;
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
        $teachers=classroom_teacher::all();
        return response()->json($teachers);
    }

    public function classroomData()
    {
        $classroom=classroom::all();
        return response()->json($classroom);
    }

}
