<?php

namespace App\Http\Controllers;

use App\Models\classRoom;
use App\Models\classRoom_Teacher;
use Illuminate\Http\Request;
use App\Models\students;
use Illuminate\Support\Facades\DB;


class ajaxRequest extends Controller
{
    public function getclassStructure(Request $request)
{$selectedValue = $request->input('classId'); 
   $classStructure = DB::table('students')
    ->join('classRoom', 'students.classRoomId', '=', 'classRoom.classRoomId')
    ->join('classRoom_teacher', 'classRoom.teacherID', '=', 'classRoom_teacher.teacherID')
    ->select('students.*', 'classRoom.className','classRoom.classroomId', 'classRoom_teacher.name AS teacher_name')
    ->where('classRoom.classroomId','=',$selectedValue)
    ->get(); 
    return response()->json($classStructure);
}

public function getTeacherDetail(Request $request)
{
    $SelectedId = $request->input('teacherId'); 
    $teacherDetail = classRoom_Teacher::WHERE('teacherId',$SelectedId)->first();
    return response()->json($teacherDetail);

}



public function getStudentDetail(Request $request)
{
    $SelectedId = $request->input('studentId'); 
    $studentDetail =  DB::table('students')
    ->join('classRoom', 'students.classroomId', '=', 'classRoom.classroomId')
    ->select('students.*', 'classRoom.className','classRoom.classroomId',)
    ->where('students.studentId','=',$SelectedId)
    ->first(); 
    return response()->json($studentDetail);

}


public function getClassRoomDetail(Request $request)
{
    $SelectedId = $request->input('classRoomId'); 

    $classRoomDetail =  DB::table('classRoom')
    ->join('classRoom_teacher', 'classRoom.teacherId', '=', 'classRoom_teacher.teacherId')
    ->select('classRoom.*', 'classRoom_teacher.name')
    ->where('classRoom.classroomId','=',$SelectedId)
    ->first(); 
   
    return response()->json($classRoomDetail);

}


// public function getDocumentDetail(Request $request)
// {
//     $SelectedId = $request->input('teacherId'); 
//     $teacherDetail = classRoom_Teacher::WHERE('teacherId',$SelectedId)->first();
//     return response()->json($teacherDetail);

// }
}
