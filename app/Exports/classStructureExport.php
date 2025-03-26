<?php

namespace App\Exports;

use App\Models\Classroom_teacher;
use App\Models\students;
use App\Models\Classroom;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;

class classStructureExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    protected $classId;
    protected $class_name;
    protected $teacherName;

    public function __construct($classId)
    {
        $this->classId = $classId;
        // Fetch class information based on classId
        $class_name = Classroom::find($classId);
        $classTeacher = Classroom_teacher::find($class_name->teacher_id);
        $this->class_name = $class_name ? $class_name->class_name : '';
        $this->teacherName = $classTeacher ? $classTeacher->name : '';
    }

    public function collection()
    {
        // Your existing query logic
        return students::RightJoin('Classroom', 'students.Classroom_id', '=', 'Classroom.Classroom_id')
            ->RightJoin('Classroom_teacher', 'Classroom.teacher_id', '=', 'Classroom_teacher.teacher_id')
            ->select(
                'students.student_id',
                'students.name',
                'students.ic_number',
                'students.no_tell',
                'students.email',
                'students.family_income ',
                'students.total_family_member',
                'students.Classroom_id',
                'Classroom.class_name' // Add class_name to the select statement
            )
            ->where('Classroom.Classroom_id', '=', $this->classId)
            ->get();
    }

    public function headings(): array
    {
        return [
            ['Class Name: ' . $this->class_name], // First row of the header
            ['Teacher Name: ' . $this->teacherName], // Second row of the header
            [
                'student_id',
                'name',
                'ic_number',
                'no_tell',
                'email',
                'family_income ',
                'total_family_member',
                'Classroom_id',
                'class_name',
            ],
        ];
    }


      /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                $event->sheet->setTitle('Student Details');
                $event->sheet->getStyle('A3:I3')->applyFromArray([
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
