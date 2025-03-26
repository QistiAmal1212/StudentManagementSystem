<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Models\Classroom_teacher;
use App\Models\Classroom;
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
        $Classroom = DB::table('Classroom')
        ->join('Classroom_teacher', 'Classroom.teacher_id', '=', 'Classroom_teacher.teacher_id')
        ->select('Classroom.*', 'Classroom_teacher.name')
        ->get();
        $ClassroomTest = $Classroom;

        foreach($ClassroomTest as  $ClassroomTest){

        $totalstudent[$j] = students::where('Classroom_id',$ClassroomTest->Classroom_id)->count();
         $j++;
        }

        $totalClassroom = Classroom::count();
        $totalTeachers = Classroom_teacher::count();
        $totalStudents = students::count();
        $totalPoorStudents = students::whereNull('family_income')->count();
        $latestDate1 = Classroom::latest('updated_at')->first();
        $latestDate2 = Classroom_teacher::latest('updated_at')->first();
        $latestDate3 = students::latest('updated_at')->first();
        $latestDate4 = students::whereRaw('(family_income  / total_family_member) < 1250')->latest('updated_at')->first();

        $totalStudentForEachForm = [];

        for ($i = 1; $i <= 6; $i++) {
            ${"totalStudentsForm" . $i} = DB::table('students')
                ->join('Classroom', 'students.Classroom_id', '=', 'Classroom.Classroom_id')
                ->where('Classroom.form', $i)
                ->count();

            $totalStudentForEachForm[] = ${"totalStudentsForm" . $i};
        }

        $totalPoorStudentForEachForm = [];

        for ($i = 1; $i <= 6; $i++) {
            ${"totalPoorStudentForEachForm" . $i} = DB::table('students')
                ->join('Classroom', 'students.Classroom_id', '=', 'Classroom.Classroom_id')
                ->where('Classroom.form', $i)
                ->whereRaw('(family_income  / total_family_member) < 1250')
                ->count();

                $totalPoorStudentForEachForm[] = ${"totalPoorStudentForEachForm" . $i};
        }


        return view("dashboard",compact('Classroom','totalClassroom','totalTeachers','totalStudents','totalstudent',
        'totalPoorStudents','totalStudentForEachForm','totalPoorStudentForEachForm','latestDate1','latestDate2','latestDate3','latestDate4'));
    }


    public function classStructure()
    {

        $Classroom = Classroom::all();



        return view("Pages.class-structure",compact('Classroom'));

    }

    public function Classroom()
    {
        $Classroom = DB::table('Classroom')
        ->join('Classroom_teacher', 'Classroom.teacher_id', '=', 'Classroom_teacher.teacher_id')
        ->select('Classroom.*', 'Classroom_teacher.name')
        ->get();


        $totalstudent=[];
        $ClassroomTest = $Classroom;
        $j=1;
        foreach($ClassroomTest as  $ClassroomTest){

        $totalstudent[$j] = students::where('Classroom_id',$ClassroomTest->Classroom_id)->count();
         $j++;
        }

        $teachers = Classroom_teacher::WHERE('is_class_teacher',0)->get();
        $teachers2 = Classroom_teacher::WHERE('is_class_teacher',0)->get();

        return view("Pages.Classroom",compact('Classroom','teachers','teachers2','totalstudent'));

    }

    public function students()
    {
        $students = DB::table('students')
        ->join('Classroom', 'students.Classroom_id', '=', 'Classroom.Classroom_id')
        ->join('Classroom_teacher', 'Classroom.teacher_id', '=', 'Classroom_teacher.teacher_id')
        ->select('students.*', 'Classroom.class_name', 'Classroom_teacher.name AS teacher_name')
        ->get();
        $class = Classroom::all();
        $class2 = Classroom::all();

        return view("Pages.students",compact('students','class','class2'));

    }

    public function teachers()
    {

        $teachers = Classroom_teacher::all();


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
        $Classroom = Classroom::all();
        $studentResult=studentResult::all();
        return view("Pages.grading",compact('exam','Classroom','studentResult'));

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
        $emails = Classroom_teacher::select('email')
    ->union(students::select('email'))
    ->get();
        return view("Pages.email",compact('documents','emails'));

    }


    // public function report(Request $request)
    // {

    //     $exam = exam::all();
    //     $Classroom = Classroom::all();
    //     $studentResult=studentResult::all();

    //     return view("Pages.examReport",compact('exam','Classroom','studentResult'));
    // }

}
