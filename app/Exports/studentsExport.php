<?php

namespace App\Exports;

use App\Models\students;
use App\Models\classRoom; // Import the classRoom model
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class studentsExport implements FromCollection, WithHeadings, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Retrieve students with className
        $students = students::select(
            'students.studentId',
            'students.name',
            'students.icNumber',
            'students.noTell',
            'students.email',
            'students.familyIncome',
            'students.totalFamilyMember',
            'students.classroomId',
            'classRoom.className' // Add className to the select statement
        )
            ->join('classRoom', 'students.classroomId', '=', 'classRoom.classroomId')
            ->get();

        return $students;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'studentId',
            'name',
            'icNumber',
            'noTell',
            'email',
            'familyIncome',
            'totalFamilyMember',
            'classroomId',
            'className', // Add the new column
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
