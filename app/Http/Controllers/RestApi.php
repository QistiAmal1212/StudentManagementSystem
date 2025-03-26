<?php

namespace App\Http\Controllers;


use App\Models\class_room;
use App\Models\class_room_teacher;
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
        $teachers=class_room_teacher::all();
        return response()->json($teachers);
    }

    public function class_roomData()
    {
        $class_room=class_room::all();
        return response()->json($class_room);
    }

}
