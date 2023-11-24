<?php

namespace App\Http\Controllers;

use App\Models\classRoom;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\classRoom_Teacher;
use App\Models\students;
use Illuminate\Support\Facades\DB;
class pdfExport extends Controller
{
    public function exportPdfTeacher()
    {
        
        $teachers = classRoom_Teacher::all();
        $pdf = Pdf::loadView('Pdf.teachers',compact('teachers'));
        return $pdf->download('teachers.pdf');

    }


    public function exportPdfStudent()
    {
        
        $students = students::all();
        $pdf = Pdf::loadView('Pdf.students',compact('students'));
        return $pdf->download('students.pdf');

    }

    public function exportPdfClassRoom()
    {
        
        $classRoom = DB::table('classRoom')
        ->join('classRoom_teacher', 'classRoom.teacherID', '=', 'classRoom_teacher.teacherID')
        ->select('classRoom.*', 'classRoom_teacher.name')
        ->get();

        $pdf = Pdf::loadView('Pdf.classRoom',compact('classRoom'));
        return $pdf->download('classRoom.pdf');
        
    }

    public function exportPdfClassStructure($id)
    {
        $classRoomDetail = DB::table('students')
        ->rightJoin('classRoom', 'students.classRoomId', '=', 'classRoom.classRoomId')
        ->rightJoin('classRoom_teacher', 'classRoom.teacherID', '=', 'classRoom_teacher.teacherID')
        ->select('students.*', 'classRoom.className','classRoom.classroomId', 'classRoom_teacher.name AS teacher_name')
        ->where('classRoom.classroomId','=',$id)
        ->get(); 
        $pdf = Pdf::loadView('Pdf.classRoomStructure',compact('classRoomDetail','id'));
        return $pdf->download('classRoomStructure.pdf');
        
    }
}
