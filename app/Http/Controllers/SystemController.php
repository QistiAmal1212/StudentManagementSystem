<?php

namespace App\Http\Controllers;

use App\Models\ClassroomTeacher;
use App\Models\Classroom;
use App\Models\Documents;
use App\Models\Exam;
use App\Models\StudentResult;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SystemController extends Controller
{

    public function dashboard()
    {   $totalstudent=[];
        $j=1;
        $classroom = DB::table('classroom')
        ->join('classroom_teacher', 'classroom.teacher_id', '=', 'classroom_teacher.teacher_id')
        ->select('classroom.*', 'classroom_teacher.name')
        ->get();
        $classroomTest = $classroom;

        foreach($classroomTest as  $classroomTest){

        $totalstudent[$j] = Students::where('classroom_id',$classroomTest->classroom_id)->count();
         $j++;
        }

        $totalclassroom = Classroom::count();
        $totalTeachers = ClassroomTeacher::count();
        $totalStudents = Students::count();
        $totalPoorStudents = Students::whereNull('family_income')->count();
        $latestDate1 = Classroom::latest('updated_at')->first();
        $latestDate2 = ClassroomTeacher::latest('updated_at')->first();
        $latestDate3 = Students::latest('updated_at')->first();
        $latestDate4 = Students::whereRaw('(family_income  / total_family_member) < 1250')->latest('updated_at')->first();

        $totalStudentForEachForm = [];

        for ($i = 1; $i <= 6; $i++) {
            ${"totalStudentsForm" . $i} = DB::table('students')
                ->join('classroom', 'students.classroom_id', '=', 'classroom.classroom_id')
                ->where('classroom.form', $i)
                ->count();

            $totalStudentForEachForm[] = ${"totalStudentsForm" . $i};
        }

        $totalPoorStudentForEachForm = [];

        for ($i = 1; $i <= 6; $i++) {
            ${"totalPoorStudentForEachForm" . $i} = DB::table('students')
                ->join('classroom', 'students.classroom_id', '=', 'classroom.classroom_id')
                ->where('classroom.form', $i)
                ->whereRaw('(family_income  / total_family_member) < 1250')
                ->count();

                $totalPoorStudentForEachForm[] = ${"totalPoorStudentForEachForm" . $i};
        }


        return view("dashboard",compact('classroom','totalclassroom','totalTeachers','totalStudents','totalstudent',
        'totalPoorStudents','totalStudentForEachForm','totalPoorStudentForEachForm','latestDate1','latestDate2','latestDate3','latestDate4'));
    }


    public function classStructure()
    {

        $classroom = Classroom::all();



        return view("Pages.class-structure",compact('classroom'));

    }

    public function classroom()
    {
        $classroom = DB::table('classroom')
        ->join('classroom_teacher', 'classroom.teacher_id', '=', 'classroom_teacher.teacher_id')
        ->select('classroom.teacher_id', 'classroom.teacher_id', 'classroom_teacher.name as teacher_name')
        ->get();



        $totalstudent=[];
        $classroomTest = $classroom;
        $j=1;
        foreach($classroomTest as  $classroomTest){

        $totalstudent[$j] = Students::where('classroom_id',$classroomTest->classroom_id)->count();
         $j++;
        }

        $teachers = ClassroomTeacher::WHERE('is_class_teacher',0)->get();
        $teachers2 = ClassroomTeacher::WHERE('is_class_teacher',0)->get();

        return view("Pages.classroom",compact('classroom','teachers','teachers2','totalstudent'));

    }

    public function students()
    {
        $students = DB::table('students')
        ->join('classroom', 'students.classroom_id', '=', 'classroom.classroom_id')
        ->join('classroom_teacher', 'classroom.teacher_id', '=', 'classroom_teacher.teacher_id')
        ->select('students.*', 'classroom.class_name', 'classroom_teacher.name AS teacher_name')
        ->get();
        $class = Classroom::all();
        $class2 = Classroom::all();

        return view("Pages.students",compact('students','class','class2'));

    }

    public function teachers()
    {

        $teachers = ClassroomTeacher::all();


        return view("Pages.teachers",compact('teachers'));

    }

    public function exam()
    {

        $exam = Exam::all();


        return view("Pages.exam",compact('exam'));

    }

    public function grading()
    {

        $exam = Exam::all();
        $classroom = Classroom::all();
        $student_result=StudentResult::all();
        return view("Pages.grading",compact('exam','classroom','student_result'));

    }


    public function examReport(Request $request)
    {

        if($request->input('exam_id'))
        {
         $testId=$request->input('exam_id');
         $exam = Exam::all();
         $student_result=StudentResult::Where('exam_id',$testId) ->orderBy('average', 'desc')->get();
         $class_names = $student_result->unique('class_name')->pluck('class_name');


         $reportResult1 = [];
         $reportResult2 = [];

         foreach ($class_names as $class_name) {
            $average = $student_result->where('class_name', $class_name)->avg('average');
             $reportResult1[] = $class_name;
             $reportResult2[] = $average;
         }

        }

        else{
        $exam = Exam::all();
        $examtest = Exam::first();
        $student_result=StudentResult::Where('exam_id',$examtest->exam_id) ->orderBy('average', 'desc')->get();

        $class_names = $student_result->unique('class_name')->pluck('class_name');

        $reportResult1 = [];
        $reportResult2 = [];

        foreach ($class_names as $class_name) {
            $average = $student_result->where('class_name', $class_name)->avg('average');
            $reportResult1[] = $class_name;
            $reportResult2[] = $average;
        }
        }


        return view("Pages.examReport",compact('exam','student_result','reportResult1','reportResult2'));

    }



    public function analysis()
    {
        return view("Pages.analysis");

    }

    public function document()
    {
        $documents = Documents::all();
        return view("Pages.document",compact('documents'));

    }

    public function email()
    {
        $documents = Documents::all();
        $emails = ClassroomTeacher::select('email')
    ->union(Students::select('email'))
    ->get();
        return view("Pages.email",compact('documents','emails'));

    }


    // public function report(Request $request)
    // {

    //     $exam = exam::all();
    //     $classroom = classroom::all();
    //     $student_result=student_result::all();

    //     return view("Pages.examReport",compact('exam','classroom','student_result'));
    // }

}
