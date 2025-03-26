<?php

namespace App\Http\Controllers;

use App\Models\class_room;
use App\Models\class_room_teacher;
use App\Models\exam;
use App\Models\studentResult;
use Illuminate\Http\Request;
use App\Models\students;
use Illuminate\Support\Facades\DB;


class ajaxRequest extends Controller
{
    public function getclassStructure(Request $request)
    {
        $selectedValue = $request->input('classId');

        $classStructure = DB::table('students')
            ->rightJoin('class_room', 'students.class_room_id', '=', 'class_room.class_room_id')
            ->rightJoin('class_room_teacher', 'class_room.teacher_id', '=', 'class_room_teacher.teacher_id')
            ->select('students.*', 'class_room.class_name', 'class_room.class_room_id', 'class_room_teacher.name AS teacher_name')
            ->where('class_room.class_room_id', '=', $selectedValue)
            ->get();

        return response()->json($classStructure);
    }


public function getTeacherDetail(Request $request)
{
    $SelectedId = $request->input('teacher_id');
    $teacherDetail = class_room_teacher::WHERE('teacher_id',$SelectedId)->first();
    return response()->json($teacherDetail);

}



public function getStudentDetail(Request $request)
{
    $SelectedId = $request->input('student_id');
    $studentDetail =  DB::table('students')
    ->join('class_room', 'students.class_room_id', '=', 'class_room.class_room_id')
    ->select('students.*', 'class_room.class_name','class_room.class_room_id',)
    ->where('students.student_id','=',$SelectedId)
    ->first();
    return response()->json($studentDetail);

}


public function getclass_roomDetail(Request $request)
{
    $SelectedId = $request->input('class_room_id');

    $class_roomDetail =  DB::table('class_room')
    ->join('class_room_teacher', 'class_room.teacher_id', '=', 'class_room_teacher.teacher_id')
    ->select('class_room.*', 'class_room_teacher.name')
    ->where('class_room.class_room_id','=',$SelectedId)
    ->first();

    return response()->json($class_roomDetail);

}


public function getStudentResult(Request $request)
{
    $SelectedExam = $request->input('exam_id');
    $SelectedClass = $request->input('class_room_id');

    $students = DB::table('students')
        ->rightJoin('class_room', 'students.class_room_id', '=', 'class_room.class_room_id')
        ->select('students.*', 'class_room.class_name')
        ->where('students.class_room_id', '=', $SelectedClass)
        ->get();

    $ic_numbers = $students->pluck('ic_number');
    $studentResult = studentResult::whereIn('ic_number', $ic_numbers)
    ->whereIn('status', ['successful']) // Use an array for the 'status' field
    ->where('exam_id', $SelectedExam)
    ->get();

$studentResultPending = studentResult::whereIn('ic_number', $ic_numbers)
    ->whereIn('status', ['pending']) // Use an array for the 'status' field
    ->where('exam_id', $SelectedExam)
    ->get();
$results=[$studentResult,$studentResultPending];

    // Return the combined result as JSON
    return response()->json($results);
}


public function getClassData(Request $request){
    $SelectedExam = $request->input('exam_id');
    $exam = exam::where('exam_id',$SelectedExam)->first();
    $checkform = $exam->form;

    $class_room = class_room::where('form',$checkform)->get();
    return response()->json($class_room);

}

public function getStudentResult2(Request $request)
{
    $SelectedIc = $request->input('studentIc');
    $studentResult = studentResult::Where('ic_number',$SelectedIc)->first();
    return response()->json($studentResult);
}

// public function getDocumentDetail(Request $request)
// {
//     $SelectedId = $request->input('teacher_id');
//     $teacherDetail = class_room_teacher::WHERE('teacher_id',$SelectedId)->first();
//     return response()->json($teacherDetail);

// }
}
