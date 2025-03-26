<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Classroom_teacher;
use App\Models\students;
use Illuminate\Support\Facades\DB;
class pdfExport extends Controller
{
    public function exportPdfTeacher()
    {

        $teachers = Classroom_teacher::all();
        $pdf = Pdf::loadView('Pdf.teachers',compact('teachers'));
        return $pdf->download('teachers.pdf');

    }


    public function exportPdfStudent()
    {

        $students = students::all();
        $pdf = Pdf::loadView('Pdf.students',compact('students'));
        return $pdf->download('students.pdf');

    }

    public function exportPdfClassroom()
    {

        $Classroom = DB::table('Classroom')
        ->join('Classroom_teacher', 'Classroom.teacher_id', '=', 'Classroom_teacher.teacher_id')
        ->select('Classroom.*', 'Classroom_teacher.name')
        ->get();

        $pdf = Pdf::loadView('Pdf.Classroom',compact('Classroom'));
        return $pdf->download('Classroom.pdf');

    }

    public function exportPdfClassStructure($id)
    {
        $ClassroomDetail = DB::table('students')
        ->rightJoin('Classroom', 'students.Classroom_id', '=', 'Classroom.Classroom_id')
        ->rightJoin('Classroom_teacher', 'Classroom.teacher_id', '=', 'Classroom_teacher.teacher_id')
        ->select('students.*', 'Classroom.class_name','Classroom.Classroom_id', 'Classroom_teacher.name AS teacher_name')
        ->where('Classroom.Classroom_id','=',$id)
        ->get();
        $pdf = Pdf::loadView('Pdf.ClassroomStructure',compact('ClassroomDetail','id'));
        return $pdf->download('ClassroomStructure.pdf');

    }
}
