<?php

namespace app\Http\Controllers;


use Barryvdh\DomPDF\Facade\Pdf;
use app\Models\ClassroomTeacher;
use app\Models\Students;
use Illuminate\Support\Facades\DB;
class PdfExport extends Controller
{
    public function exportPdfTeacher()
    {

        $teachers = ClassroomTeacher::all();
        $pdf = Pdf::loadView('Pdf.teachers',compact('teachers'));
        return $pdf->download('teachers.pdf');

    }


    public function exportPdfStudent()
    {

        $students = Student::all();
        $pdf = Pdf::loadView('Pdf.students',compact('students'));
        return $pdf->download('Student.pdf');

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
        ->rightJoin('classroom', 'Student.classroom_id', '=', 'classroom.classroom_id')
        ->rightJoin('classroom_teacher', 'classroom.teacher_id', '=', 'classroom_teacher.teacher_id')
        ->select('Student.*', 'classroom.class_name','classroom.classroom_id', 'classroom_teacher.name AS teacher_name')
        ->where('classroom.classroom_id','=',$id)
        ->get();
        $pdf = Pdf::loadView('Pdf.classroomStructure',compact('classroomDetail','id'));
        return $pdf->download('classroomStructure.pdf');

    }
}
