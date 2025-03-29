<?php

namespace app\Exports;

use app\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class StudentsExport implements FromCollection, WithHeadings, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Retrieve students with class_name
        $students = Student::select(
            'students.student_id',
            'students.name',
            'students.ic_number',
            'students.no_tell',
            'students.email',
            'students.family_income ',
            'students.total_family_member',
            'students.classroom_id',
            'classroom.class_name' // Add class_name to the select statement
        )
            ->join('classroom', 'students.classroom_id', '=', 'classroom.classroom_id')
            ->get();

        return $students;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'student_id',
            'name',
            'ic_number',
            'no_tell',
            'email',
            'family_income ',
            'total_family_member',
            'classroom_id',
            'class_name', // Add the new column
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
                $event->sheet->getColumnDimension('G')->setWidth(20);
                $event->sheet->getColumnDimension('H')->setWidth(45);
                $event->sheet->getColumnDimension('I')->setWidth(30); // Adjust the width for the new column
                $event->sheet->setTitle('Student Details');
                $event->sheet->getStyle('A1:I1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                    'fill' => [
                   'fillType' => 'solid',
                        'startColor' => [
                            'rgb' => 'F5F5F5',
                        ],
                    ],
                ]);
            },
        ];
    }
}
