<?php

namespace App\Http\Controllers;

use App\Exports\ClassroomExport;
use App\Exports\ClassStructureExport;
use App\Exports\StudentsExport;
use Illuminate\Http\Request;
use App\exports\Teachers;


class ExcelExport extends Controller
{
    public function exportExcelTeachers()
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new Teachers, 'Teachers.xlsx');

    }

    public function exportExcelStudents()
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new StudentsExport, 'Students.xlsx');

    }

    public function exportExcelclassroom()
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new ClassroomExport, 'classroom.xlsx');
    }

    public function exportExcelClassStructure($id)
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new ClassStructureExport($id), 'classroom.xlsx');

    }
}
