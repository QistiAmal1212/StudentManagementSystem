<?php

namespace app\Http\Controllers;

use app\Exports\ClassroomExport;
use app\Exports\ClassStructureExport;
use app\Exports\StudentsExport;
use Illuminate\Http\Request;
use app\exports\Teachers;


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
