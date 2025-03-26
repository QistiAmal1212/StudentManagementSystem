<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Models\class_room_teacher;
use App\Models\class_room;
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
        $class_room = DB::table('class_room')
        ->join('class_room_teacher', 'class_room.teacher_id', '=', 'class_room_teacher.teacher_id')
        ->select('class_room.*', 'class_room_teacher.name')
        ->get();
        $class_roomTest = $class_room;

        foreach($class_roomTest as  $class_roomTest){

        $totalstudent[$j] = students::where('class_room_id',$class_roomTest->class_room_id)->count();
         $j++;
        }

        $totalclass_room = class_room::count();
        $totalTeachers = class_room_teacher::count();
        $totalStudents = students::count();
        $totalPoorStudents = students::whereNull('family_income')->count();
        $latestDate1 = class_room::latest('updated_at')->first();
        $latestDate2 = class_room_teacher::latest('updated_at')->first();
        $latestDate3 = students::latest('updated_at')->first();
        $latestDate4 = students::whereRaw('(family_income  / total_family_member) < 1250')->latest('updated_at')->first();

        $totalStudentForEachForm = [];

        for ($i = 1; $i <= 6; $i++) {
            ${"totalStudentsForm" . $i} = DB::table('students')
                ->join('class_room', 'students.class_room_id', '=', 'class_room.class_room_id')
                ->where('class_room.form', $i)
                ->count();

            $totalStudentForEachForm[] = ${"totalStudentsForm" . $i};
        }

        $totalPoorStudentForEachForm = [];

        for ($i = 1; $i <= 6; $i++) {
            ${"totalPoorStudentForEachForm" . $i} = DB::table('students')
                ->join('class_room', 'students.class_room_id', '=', 'class_room.class_room_id')
                ->where('class_room.form', $i)
                ->whereRaw('(family_income  / total_family_member) < 1250')
                ->count();

                $totalPoorStudentForEachForm[] = ${"totalPoorStudentForEachForm" . $i};
        }


        return view("dashboard",compact('class_room','totalclass_room','totalTeachers','totalStudents','totalstudent',
        'totalPoorStudents','totalStudentForEachForm','totalPoorStudentForEachForm','latestDate1','latestDate2','latestDate3','latestDate4'));
    }


    public function classStructure()
    {

        $class_room = class_room::all();



        return view("Pages.class-structure",compact('class_room'));

    }

    public function class_room()
    {
        $class_room = DB::table('class_room')
        ->join('class_room_teacher', 'class_room.teacher_id', '=', 'class_room_teacher.teacher_id')
        ->select('class_room.*', 'class_room_teacher.name')
        ->get();


        $totalstudent=[];
        $class_roomTest = $class_room;
        $j=1;
        foreach($class_roomTest as  $class_roomTest){

        $totalstudent[$j] = students::where('class_room_id',$class_roomTest->class_room_id)->count();
         $j++;
        }

        $teachers = class_room_teacher::WHERE('is_class_teacher',0)->get();
        $teachers2 = class_room_teacher::WHERE('is_class_teacher',0)->get();

        return view("Pages.class_room",compact('class_room','teachers','teachers2','totalstudent'));

    }

    public function students()
    {
        $students = DB::table('students')
        ->join('class_room', 'students.class_room_id', '=', 'class_room.class_room_id')
        ->join('class_room_teacher', 'class_room.teacher_id', '=', 'class_room_teacher.teacher_id')
        ->select('students.*', 'class_room.class_name', 'class_room_teacher.name AS teacher_name')
        ->get();
        $class = class_room::all();
        $class2 = class_room::all();

        return view("Pages.students",compact('students','class','class2'));

    }

    public function teachers()
    {

        $teachers = class_room_teacher::all();


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
        $class_room = class_room::all();
        $studentResult=studentResult::all();
        return view("Pages.grading",compact('exam','class_room','studentResult'));

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
        $emails = class_room_teacher::select('email')
    ->union(students::select('email'))
    ->get();
        return view("Pages.email",compact('documents','emails'));

    }


    // public function report(Request $request)
    // {

    //     $exam = exam::all();
    //     $class_room = class_room::all();
    //     $studentResult=studentResult::all();

    //     return view("Pages.examReport",compact('exam','class_room','studentResult'));
    // }

}
