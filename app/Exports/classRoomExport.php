<?php

namespace App\Exports;

use App\Models\classRoom;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;


class classRoomExport implements FromCollection, WithHeadings, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
   public function collection()
    {
        // Use the query builder to join with classRoom_Teacher and get the teacher name
        $classrooms = classRoom::select(
            'classRoom.classroomId',
            'classRoom.className',
            'classRoom.form',
            'classRoom.teacherId',
            'classRoom_Teacher.name' // Add the teacherName field
        )
            ->leftJoin('classRoom_Teacher', 'classRoom.teacherId', '=', 'classRoom_Teacher.teacherId')
            ->get();

        return $classrooms;
    }

       /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'classroomId',
            'className',
            'form',
            'teacherId',
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
