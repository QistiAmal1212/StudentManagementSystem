<?php
namespace App\Imports;

use App\Models\students;
use App\Models\ClassRoom;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Validator;

class studentsImport implements ToModel
{
    private $rowCount = 0;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $this->rowCount++;

        if (
            students::where('name', $row[0])->exists() ||
            students::where('email', $row[3])->exists()
        ) {
            abort(422, 'row ' . $this->rowCount . ': Duplicate data found.');
        }

        // Perform existence check for classroomId
        if (!ClassRoom::where('classroomId', $row[6])->exists()) {
            abort(422, 'row ' . $this->rowCount . ': Invalid classroomId.');
        }

        // If all checks pass, create a new students model
        return new students([
            'name' => (string) $row[0],
            'icNumber' => (string) $row[1],
            'noTell' => (string) $row[2],
            'email' => (string) $row[3],
            'familyIncome' => (float) $row[4],
            'totalFamilyMember' => (int) $row[5],
            'classroomId' => (string) $row[6],
        ]);
    }
}

