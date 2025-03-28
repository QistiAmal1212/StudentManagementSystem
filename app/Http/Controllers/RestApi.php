<?php

namespace app\Http\Controllers;


use app\Models\Classroom;
use app\Models\ClassroomTeacher;
use app\Models\Student;
use Illuminate\Http\Request;

class RestApi extends Controller
{
    public function StudentData()
    {
        $students=Student::all();
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
