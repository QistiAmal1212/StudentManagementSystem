<?php

namespace App\Exports;

use App\Models\classRoom_Teacher;
use App\Models\students;
use App\Models\ClassRoom;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;

class classStructureExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    protected $classId;
    protected $className;
    protected $teacherName;

    public function __construct($classId)
    {
        $this->classId = $classId;
        // Fetch class information based on classId
        $className = ClassRoom::find($classId);
        $classTeacher = classRoom_Teacher::find($className->teacherId);
        $this->className = $className ? $className->className : '';
        $this->teacherName = $classTeacher ? $classTeacher->name : '';
    }

    public function collection()
    {
        // Your existing query logic
        return students::RightJoin('classRoom', 'students.classRoomId', '=', 'classRoom.classRoomId')
            ->RightJoin('classRoom_teacher', 'classRoom.teacherID', '=', 'classRoom_teacher.teacherID')
            ->select(
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
            ->where('classRoom.classroomId', '=', $this->classId)
            ->get();
    }

    public function headings(): array
    {
        return [
            ['Class Name: ' . $this->className], // First row of the header
            ['Teacher Name: ' . $this->teacherName], // Second row of the header
            [
                'studentId',
                'name',
                'icNumber',
                'noTell',
                'email',
                'familyIncome',
                'totalFamilyMember',
                'classroomId',
                'className',
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
