<?php

namespace App\Http\Controllers;

use App\Models\classRoom;
use App\Models\classRoom_Teacher;
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
            ->rightJoin('classRoom', 'students.classRoomId', '=', 'classRoom.classRoomId')
            ->rightJoin('classRoom_Teacher', 'classRoom.teacherId', '=', 'classRoom_Teacher.teacherId')
            ->select('students.*', 'classRoom.className', 'classRoom.classroomId', 'classRoom_Teacher.name AS teacher_name')
            ->where('classRoom.classroomId', '=', $selectedValue)
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
    ->join('classRoom_Teacher', 'classRoom.teacherId', '=', 'classRoom_Teacher.teacherId')
    ->select('classRoom.*', 'classRoom_Teacher.name')
    ->where('classRoom.classroomId','=',$SelectedId)
    ->first();

    return response()->json($classRoomDetail);

}


public function getStudentResult(Request $request)
{
    $SelectedExam = $request->input('examId');
    $SelectedClass = $request->input('classroomId');

    $students = DB::table('students')
        ->rightJoin('classRoom', 'students.classRoomId', '=', 'classRoom.classRoomId')
        ->select('students.*', 'classRoom.className')
        ->where('students.classroomId', '=', $SelectedClass)
        ->get();

    $icNumbers = $students->pluck('icNumber');
    $studentResult = studentResult::whereIn('icNumber', $icNumbers)
    ->whereIn('status', ['successful']) // Use an array for the 'status' field
    ->where('examId', $SelectedExam)
    ->get();

$studentResultPending = studentResult::whereIn('icNumber', $icNumbers)
    ->whereIn('status', ['pending']) // Use an array for the 'status' field
    ->where('examId', $SelectedExam)
    ->get();
$results=[$studentResult,$studentResultPending];

    // Return the combined result as JSON
    return response()->json($results);
}


public function getClassData(Request $request){
    $SelectedExam = $request->input('examId');
    $exam = exam::where('examId',$SelectedExam)->first();
    $checkform = $exam->form;

    $classRoom = classRoom::where('form',$checkform)->get();
    return response()->json($classRoom);

}

public function getStudentResult2(Request $request)
{
    $SelectedIc = $request->input('studentIc');
    $studentResult = studentResult::Where('icNumber',$SelectedIc)->first();
    return response()->json($studentResult);
}

// public function getDocumentDetail(Request $request)
// {
//     $SelectedId = $request->input('teacherId');
//     $teacherDetail = classRoom_Teacher::WHERE('teacherId',$SelectedId)->first();
//     return response()->json($teacherDetail);

// }
}
