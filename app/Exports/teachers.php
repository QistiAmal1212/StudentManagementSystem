<?php

namespace App\Exports;

use App\Models\Classroom_teacher;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class teachers implements FromCollection, WithHeadings, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Retrieve specific data from the model
        $teachers = Classroom_teacher::select(
            'teacher_id',
            'name',
            'ic_number',
            'no_tell',
            'email',
            'is_class_teacher'
        )->get();

        // Modify the data to represent 0 as "No" and 1 as "Yes"
        $modifiedData = $teachers->map(function ($teacher) {
            return [
                'Teacher ID'        => $teacher->teacher_id,
                'Name'              => $teacher->name,
                'IC Number'         => $teacher->ic_number,
                'Phone Number'      => $teacher->no_tell,
                'Email'             => $teacher->email,
                'Is Class Teacher'  => $teacher->is_class_teacher ? 'Yes' : 'No',
            ];
        });

        return $modifiedData;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        // Define the headers for your Excel file
        return [
            'Teacher ID',
            'Name',
            'IC Number',
            'Phone Number',
            'Email',
            'Is Class Teacher',
        ];
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Set column widths
                $event->sheet->getColumnDimension('A')->setWidth(45);
                $event->sheet->getColumnDimension('B')->setWidth(45);
                $event->sheet->getColumnDimension('C')->setWidth(15);
                $event->sheet->getColumnDimension('D')->setWidth(15);
                $event->sheet->getColumnDimension('E')->setWidth(30);
                $event->sheet->getColumnDimension('F')->setWidth(15);
            },
        ];
    }
}
