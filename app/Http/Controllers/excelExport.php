<?php

namespace App\Http\Controllers;

use App\Exports\classRoomExport;
use App\Exports\classStructureExport;
use App\Exports\studentsExport;
use Illuminate\Http\Request;
use App\exports\teachers;


class excelExport extends Controller
{
    public function exportExcelTeachers() 
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new teachers, 'Teachers.xlsx');
       
    }

    public function exportExcelStudents() 
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new studentsExport, 'Students.xlsx');
       
    }

    public function exportExcelClassRoom() 
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new classRoomExport, 'ClassRoom.xlsx');
       
    }

    public function exportExcelClassStructure($id) 
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new ClassStructureExport($id), 'ClassRoom.xlsx');
       
    }
}
