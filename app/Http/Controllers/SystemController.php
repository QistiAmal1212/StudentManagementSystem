<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Models\classRoom_Teacher;
use App\Models\classRoom;
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
        $classRoom = DB::table('classRoom')
        ->join('classRoom_teacher', 'classRoom.teacherID', '=', 'classRoom_teacher.teacherID')
        ->select('classRoom.*', 'classRoom_teacher.name')
        ->get();
        $classRoomTest = $classRoom;

        foreach($classRoomTest as  $classRoomTest){

        $totalstudent[$j] = students::where('classroomId',$classRoomTest->classroomId)->count();
         $j++;
        }

        $totalClassRoom = classRoom::count();
        $totalTeachers = classRoom_Teacher::count();
        $totalStudents = students::count();
        $totalPoorStudents = students::whereRaw('(familyIncome / totalFamilyMember) < 1250')->count();
        $latestDate1 = classRoom::latest('updated_at')->first();
        $latestDate2 = classRoom_Teacher::latest('updated_at')->first();
        $latestDate3 = students::latest('updated_at')->first();
        $latestDate4 = students::whereRaw('(familyIncome / totalFamilyMember) < 1250')->latest('updated_at')->first();

        $totalStudentForEachForm = [];

        for ($i = 1; $i <= 6; $i++) {
            ${"totalStudentsForm" . $i} = DB::table('students')
                ->join('classRoom', 'students.classroomId', '=', 'classRoom.classroomId')
                ->where('classRoom.form', $i)
                ->count();
    
            $totalStudentForEachForm[] = ${"totalStudentsForm" . $i};
        }

        $totalPoorStudentForEachForm = [];

        for ($i = 1; $i <= 6; $i++) {
            ${"totalPoorStudentForEachForm" . $i} = DB::table('students')
                ->join('classRoom', 'students.classroomId', '=', 'classRoom.classroomId')
                ->where('classRoom.form', $i)
                ->whereRaw('(familyIncome / totalFamilyMember) < 1250')
                ->count();
    
                $totalPoorStudentForEachForm[] = ${"totalPoorStudentForEachForm" . $i};
        }
    

        return view("dashboard",compact('classRoom','totalClassRoom','totalTeachers','totalStudents','totalstudent',
        'totalPoorStudents','totalStudentForEachForm','totalPoorStudentForEachForm','latestDate1','latestDate2','latestDate3','latestDate4'));
    }


    public function classStructure()
    {

        $classRoom = classRoom::all();



        return view("Pages.class-structure",compact('classRoom'));

    }

    public function classRoom()
    {
        $classRoom = DB::table('classRoom')
        ->join('classRoom_teacher', 'classRoom.teacherID', '=', 'classRoom_teacher.teacherID')
        ->select('classRoom.*', 'classRoom_teacher.name')
        ->get();


        $totalstudent=[];
        $classRoomTest = $classRoom;
        $j=1;
        foreach($classRoomTest as  $classRoomTest){

        $totalstudent[$j] = students::where('classroomId',$classRoomTest->classroomId)->count();
         $j++;
        }

        $teachers = classRoom_Teacher::WHERE('isClassTeacher',0)->get();
        $teachers2 = classRoom_Teacher::WHERE('isClassTeacher',0)->get();

        return view("Pages.classRoom",compact('classRoom','teachers','teachers2','totalstudent'));

    }

    public function students()
    {
        $students = DB::table('students')
        ->join('classRoom', 'students.classRoomId', '=', 'classRoom.classRoomId')
        ->join('classRoom_teacher', 'classRoom.teacherID', '=', 'classRoom_teacher.teacherID')
        ->select('students.*', 'classRoom.className', 'classRoom_teacher.name AS teacher_name')
        ->get();
        $class = classRoom::all();
        $class2 = classRoom::all();

        return view("Pages.students",compact('students','class','class2'));

    }

    public function teachers()
    {

        $teachers = classRoom_Teacher::all();
        

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
        $classRoom = classRoom::all();
        $studentResult=studentResult::all();
        return view("Pages.grading",compact('exam','classRoom','studentResult'));

    }


    public function examReport(Request $request)
    {  
        
        if($request->input('examId'))
        { 
         $testId=$request->input('examId');
         $exam = exam::all();
         $studentResult=studentResult::Where('examId',$testId) ->orderBy('average', 'desc')->get();
         $classNames = $studentResult->unique('className')->pluck('className');


         $reportResult1 = [];
         $reportResult2 = [];

         foreach ($classNames as $className) {
            $average = $studentResult->where('className', $className)->avg('average');
             $reportResult1[] = $className;
             $reportResult2[] = $average;
         }
         
        }
      
        else{
        $exam = exam::all();
        $examtest = exam::first();
        $studentResult=studentResult::Where('examId',$examtest->examId) ->orderBy('average', 'desc')->get();

        $classNames = $studentResult->unique('className')->pluck('className');

        $reportResult1 = [];
        $reportResult2 = [];

        foreach ($classNames as $className) {
            $average = $studentResult->where('className', $className)->avg('average');
            $reportResult1[] = $className;
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
        $emails = ClassRoom_Teacher::select('email')
    ->union(students::select('email'))
    ->get();
        return view("Pages.email",compact('documents','emails'));

    }


    // public function report(Request $request)
    // {
        
    //     $exam = exam::all();
    //     $classRoom = classRoom::all();
    //     $studentResult=studentResult::all();

    //     return view("Pages.examReport",compact('exam','classRoom','studentResult'));
    // }

}
