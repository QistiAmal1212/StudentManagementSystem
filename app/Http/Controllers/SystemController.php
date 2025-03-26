<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Models\classroom_teacher;
use App\Models\classroom;
use App\Models\documents;
use App\Models\exam;
use App\Models\studentResult;
use App\Models\students;
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

        $totalstudent[$j] = students::where('classroom_id',$classroomTest->classroom_id)->count();
         $j++;
        }

        $totalclassroom = classroom::count();
        $totalTeachers = classroom_teacher::count();
        $totalStudents = students::count();
        $totalPoorStudents = students::whereNull('family_income')->count();
        $latestDate1 = classroom::latest('updated_at')->first();
        $latestDate2 = classroom_teacher::latest('updated_at')->first();
        $latestDate3 = students::latest('updated_at')->first();
        $latestDate4 = students::whereRaw('(family_income  / total_family_member) < 1250')->latest('updated_at')->first();

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

        $classroom = classroom::all();



        return view("Pages.class-structure",compact('classroom'));

    }

    public function classroom()
    {
        $classroom = DB::table('classroom')
        ->join('classroom_teacher', 'classroom.teacher_id', '=', 'classroom_teacher.teacher_id')
        ->select('classroom.*', 'classroom_teacher.name')
        ->get();


        $totalstudent=[];
        $classroomTest = $classroom;
        $j=1;
        foreach($classroomTest as  $classroomTest){

        $totalstudent[$j] = students::where('classroom_id',$classroomTest->classroom_id)->count();
         $j++;
        }

        $teachers = classroom_teacher::WHERE('is_class_teacher',0)->get();
        $teachers2 = classroom_teacher::WHERE('is_class_teacher',0)->get();

        return view("Pages.classroom",compact('classroom','teachers','teachers2','totalstudent'));

    }

    public function students()
    {
        $students = DB::table('students')
        ->join('classroom', 'students.classroom_id', '=', 'classroom.classroom_id')
        ->join('classroom_teacher', 'classroom.teacher_id', '=', 'classroom_teacher.teacher_id')
        ->select('students.*', 'classroom.class_name', 'classroom_teacher.name AS teacher_name')
        ->get();
        $class = classroom::all();
        $class2 = classroom::all();

        return view("Pages.students",compact('students','class','class2'));

    }

    public function teachers()
    {

        $teachers = classroom_teacher::all();


        return view("Pages.teachers",compact('teachers'));

    }

    public function exam()
    {

        $exam = exam::all();


        return view("Pages.exam",compact('exam'));

    }

    public function grading()
    {

        $exam = exam::all();
        $classroom = classroom::all();
        $studentResult=studentResult::all();
        return view("Pages.grading",compact('exam','classroom','studentResult'));

    }


    public function examReport(Request $request)
    {

        if($request->input('exam_id'))
        {
         $testId=$request->input('exam_id');
         $exam = exam::all();
         $studentResult=studentResult::Where('exam_id',$testId) ->orderBy('average', 'desc')->get();
         $class_names = $studentResult->unique('class_name')->pluck('class_name');


         $reportResult1 = [];
         $reportResult2 = [];

         foreach ($class_names as $class_name) {
            $average = $studentResult->where('class_name', $class_name)->avg('average');
             $reportResult1[] = $class_name;
             $reportResult2[] = $average;
         }

        }

        else{
        $exam = exam::all();
        $examtest = exam::first();
        $studentResult=studentResult::Where('exam_id',$examtest->exam_id) ->orderBy('average', 'desc')->get();

        $class_names = $studentResult->unique('class_name')->pluck('class_name');

        $reportResult1 = [];
        $reportResult2 = [];

        foreach ($class_names as $class_name) {
            $average = $studentResult->where('class_name', $class_name)->avg('average');
            $reportResult1[] = $class_name;
            $reportResult2[] = $average;
        }
        }


        return view("Pages.examReport",compact('exam','studentResult','reportResult1','reportResult2'));

    }



    public function analysis()
    {
        return view("Pages.analysis");

    }

    public function document()
    {
        $documents = documents::all();
        return view("Pages.document",compact('documents'));

    }

    public function email()
    {
        $documents = documents::all();
        $emails = classroom_teacher::select('email')
    ->union(students::select('email'))
    ->get();
        return view("Pages.email",compact('documents','emails'));

    }


    // public function report(Request $request)
    // {

    //     $exam = exam::all();
    //     $classroom = classroom::all();
    //     $studentResult=studentResult::all();

    //     return view("Pages.examReport",compact('exam','classroom','studentResult'));
    // }

}
