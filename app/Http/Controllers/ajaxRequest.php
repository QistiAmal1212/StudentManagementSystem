<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\ClassroomTeacher;
use App\Models\Exam;
use App\Models\StudentResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AjaxRequest extends Controller
{
    public function getclassStructure(Request $request)
    {
        $selectedValue = $request->input('classId');

        $classStructure = DB::table('students')
            ->rightJoin('classroom', 'students.classroom_id', '=', 'classroom.classroom_id')
            ->rightJoin('classroom_teacher', 'classroom.teacher_id', '=', 'classroom_teacher.teacher_id')
            ->select('students.*', 'classroom.class_name', 'classroom.classroom_id', 'classroom_teacher.name AS teacher_name')
            ->where('classroom.classroom_id', '=', $selectedValue)
            ->get();

        return response()->json($classStructure);
    }


public function getTeacherDetail(Request $request)
{
    $SelectedId = $request->input('teacher_id');
    $teacherDetail = ClassroomTeacher::WHERE('teacher_id',$SelectedId)->first();
    return response()->json($teacherDetail);

}



public function getStudentDetail(Request $request)
{
    $SelectedId = $request->input('student_id');
    $studentDetail =  DB::table('students')
    ->join('classroom', 'students.classroom_id', '=', 'classroom.classroom_id')
    ->select('students.*', 'classroom.class_name','classroom.classroom_id',)
    ->where('students.student_id','=',$SelectedId)
    ->first();
    return response()->json($studentDetail);

}


public function getclassroomDetail(Request $request)
{
    $SelectedId = $request->input('classroom_id');

    $classroomDetail =  DB::table('classroom')
    ->join('classroom_teacher', 'classroom.teacher_id', '=', 'classroom_teacher.teacher_id')
    ->select('classroom.*', 'classroom_teacher.name')
    ->where('classroom.classroom_id','=',$SelectedId)
    ->first();

    return response()->json($classroomDetail);

}


public function getstudent_result(Request $request)
{
    $SelectedExam = $request->input('exam_id');
    $SelectedClass = $request->input('classroom_id');

    $students = DB::table('students')
        ->rightJoin('classroom', 'students.classroom_id', '=', 'classroom.classroom_id')
        ->select('students.*', 'classroom.class_name')
        ->where('students.classroom_id', '=', $SelectedClass)
        ->get();

    $ic_numbers = $students->pluck('ic_number');
    $student_result = StudentResult::whereIn('ic_number', $ic_numbers)
    ->whereIn('status', ['successful']) // Use an array for the 'status' field
    ->where('exam_id', $SelectedExam)
    ->get();

$student_resultPending = StudentResult::whereIn('ic_number', $ic_numbers)
    ->whereIn('status', ['pending']) // Use an array for the 'status' field
    ->where('exam_id', $SelectedExam)
    ->get();
$results=[$student_result,$student_resultPending];

    // Return the combined result as JSON
    return response()->json($results);
}


public function getClassData(Request $request){
    $SelectedExam = $request->input('exam_id');
    $exam = exam::where('exam_id',$SelectedExam)->first();
    $checkform = $exam->form;

    $classroom = classroom::where('form',$checkform)->get();
    return response()->json($classroom);

}

public function getstudent_result2(Request $request)
{
    $SelectedIc = $request->input('studentIc');
    $student_result = StudentResult::Where('ic_number',$SelectedIc)->first();
    return response()->json($student_result);
}

// public function getDocumentDetail(Request $request)
// {
//     $SelectedId = $request->input('teacher_id');
//     $teacherDetail = classroom_teacher::WHERE('teacher_id',$SelectedId)->first();
//     return response()->json($teacherDetail);

// }
}
