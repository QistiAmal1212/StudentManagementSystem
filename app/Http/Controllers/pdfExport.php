<?php

namespace App\Http\Controllers;

use App\Models\classroom;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\classroom_teacher;
use App\Models\students;
use Illuminate\Support\Facades\DB;
class pdfExport extends Controller
{
    public function exportPdfTeacher()
    {

        $teachers = classroom_teacher::all();
        $pdf = Pdf::loadView('Pdf.teachers',compact('teachers'));
        return $pdf->download('teachers.pdf');

    }


    public function exportPdfStudent()
    {

        $students = students::all();
        $pdf = Pdf::loadView('Pdf.students',compact('students'));
        return $pdf->download('students.pdf');

    }

    public function exportPdfclassroom()
    {

        $classroom = DB::table('classroom')
        ->join('classroom_teacher', 'classroom.teacher_id', '=', 'classroom_teacher.teacher_id')
        ->select('classroom.*', 'classroom_teacher.name')
        ->get();

        $pdf = Pdf::loadView('Pdf.classroom',compact('classroom'));
        return $pdf->download('classroom.pdf');

    }

    public function exportPdfClassStructure($id)
    {
        $classroomDetail = DB::table('students')
        ->rightJoin('classroom', 'students.classroom_id', '=', 'classroom.classroom_id')
        ->rightJoin('classroom_teacher', 'classroom.teacher_id', '=', 'classroom_teacher.teacher_id')
        ->select('students.*', 'classroom.class_name','classroom.classroom_id', 'classroom_teacher.name AS teacher_name')
        ->where('classroom.classroom_id','=',$id)
        ->get();
        $pdf = Pdf::loadView('Pdf.classroomStructure',compact('classroomDetail','id'));
        return $pdf->download('classroomStructure.pdf');

    }
}
