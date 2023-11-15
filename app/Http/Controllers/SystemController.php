<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Models\classRoom_Teacher;
use App\Models\classRoom;
use App\Models\documents;
use App\Models\students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SystemController extends Controller
{
  
    public function dashboard() 
    {
        $classRoom = DB::table('classRoom')
        ->join('classRoom_teacher', 'classRoom.teacherID', '=', 'classRoom_teacher.teacherID')
        ->select('classRoom.*', 'classRoom_teacher.name')
        ->get();

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
    

        return view("dashboard",compact('classRoom','totalClassRoom','totalTeachers','totalStudents',
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


        $teachers = classRoom_Teacher::WHERE('isClassTeacher',0)->get();
        $teachers2 = classRoom_Teacher::WHERE('isClassTeacher',0)->get();

        return view("Pages.classRoom",compact('classRoom','teachers','teachers2'));

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
        return view("Pages.email",compact('documents'));

    }

}
