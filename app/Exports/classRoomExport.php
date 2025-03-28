<?php

namespace app\Exports;

use app\Models\Classroom;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;


class ClassroomExport implements FromCollection, WithHeadings, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
   public function collection()
    {
        // Use the query builder to join with classroom_teacher and get the teacher name
        $classrooms = Classroom::select(
            'classroom.classroom_id',
            'classroom.class_name',
            'classroom.form',
            'classroom.teacher_id',
            'classroom_teacher.name' // Add the teacherName field
        )
            ->leftJoin('classroom_teacher', 'classroom.teacher_id', '=', 'classroom_teacher.teacher_id')
            ->get();

        return $classrooms;
    }

       /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'classroom_id',
            'class_name',
            'form',
            'teacher_id',
            'Teacher Name',

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
                $event->sheet->getColumnDimension('D')->setWidth(45);
                $event->sheet->getColumnDimension('E')->setWidth(45);
                $event->sheet->setTitle('Class Details');
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
