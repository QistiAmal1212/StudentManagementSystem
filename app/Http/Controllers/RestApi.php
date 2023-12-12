<?php

namespace App\Http\Controllers;


use App\Models\classRoom;
use App\Models\classRoom_Teacher;
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
        $teachers=classRoom_Teacher::all();
        return response()->json($teachers);
    }

    public function ClassRoomData()
    {
        $classRoom=classRoom::all();
        return response()->json($classRoom);
    }

}
