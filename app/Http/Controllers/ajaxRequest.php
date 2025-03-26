<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Classroom_teacher;
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
            ->rightJoin('Classroom', 'students.Classroom_id', '=', 'Classroom.Classroom_id')
            ->rightJoin('Classroom_teacher', 'Classroom.teacher_id', '=', 'Classroom_teacher.teacher_id')
            ->select('students.*', 'Classroom.class_name', 'Classroom.Classroom_id', 'Classroom_teacher.name AS teacher_name')
            ->where('Classroom.Classroom_id', '=', $selectedValue)
            ->get();

        return response()->json($classStructure);
    }


public function getTeacherDetail(Request $request)
{
    $SelectedId = $request->input('teacher_id');
    $teacherDetail = Classroom_teacher::WHERE('teacher_id',$SelectedId)->first();
    return response()->json($teacherDetail);

}



public function getStudentDetail(Request $request)
{
    $SelectedId = $request->input('student_id');
    $studentDetail =  DB::table('students')
    ->join('Classroom', 'students.Classroom_id', '=', 'Classroom.Classroom_id')
    ->select('students.*', 'Classroom.class_name','Classroom.Classroom_id',)
    ->where('students.student_id','=',$SelectedId)
    ->first();
    return response()->json($studentDetail);

}


public function getClassroomDetail(Request $request)
{
    $SelectedId = $request->input('Classroom_id');

    $ClassroomDetail =  DB::table('Classroom')
    ->join('Classroom_teacher', 'Classroom.teacher_id', '=', 'Classroom_teacher.teacher_id')
    ->select('Classroom.*', 'Classroom_teacher.name')
    ->where('Classroom.Classroom_id','=',$SelectedId)
    ->first();

    return response()->json($ClassroomDetail);

}


public function getStudentResult(Request $request)
{
    $SelectedExam = $request->input('exam_id');
    $SelectedClass = $request->input('Classroom_id');

    $students = DB::table('students')
        ->rightJoin('Classroom', 'students.Classroom_id', '=', 'Classroom.Classroom_id')
        ->select('students.*', 'Classroom.class_name')
        ->where('students.Classroom_id', '=', $SelectedClass)
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

    $Classroom = Classroom::where('form',$checkform)->get();
    return response()->json($Classroom);

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
//     $teacherDetail = Classroom_teacher::WHERE('teacher_id',$SelectedId)->first();
//     return response()->json($teacherDetail);

// }
}
