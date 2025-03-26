<?php

namespace App\Http\Controllers;

use App\Models\class_room;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\class_room_teacher;
use App\Models\students;
use Illuminate\Support\Facades\DB;
class pdfExport extends Controller
{
    public function exportPdfTeacher()
    {

        $teachers = class_room_teacher::all();
        $pdf = Pdf::loadView('Pdf.teachers',compact('teachers'));
        return $pdf->download('teachers.pdf');

    }


    public function exportPdfStudent()
    {

        $students = students::all();
        $pdf = Pdf::loadView('Pdf.students',compact('students'));
        return $pdf->download('students.pdf');

    }

    public function exportPdfclass_room()
    {

        $class_room = DB::table('class_room')
        ->join('class_room_teacher', 'class_room.teacher_id', '=', 'class_room_teacher.teacher_id')
        ->select('class_room.*', 'class_room_teacher.name')
        ->get();

        $pdf = Pdf::loadView('Pdf.class_room',compact('class_room'));
        return $pdf->download('class_room.pdf');

    }

    public function exportPdfClassStructure($id)
    {
        $class_roomDetail = DB::table('students')
        ->rightJoin('class_room', 'students.class_room_id', '=', 'class_room.class_room_id')
        ->rightJoin('class_room_teacher', 'class_room.teacher_id', '=', 'class_room_teacher.teacher_id')
        ->select('students.*', 'class_room.class_name','class_room.class_room_id', 'class_room_teacher.name AS teacher_name')
        ->where('class_room.class_room_id','=',$id)
        ->get();
        $pdf = Pdf::loadView('Pdf.class_roomStructure',compact('class_roomDetail','id'));
        return $pdf->download('class_roomStructure.pdf');

    }
}
