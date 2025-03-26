<?php
namespace App\Imports;

use App\Models\students;
use App\Models\class_room;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\WithStartRow;
class studentsImport implements ToModel,WithStartRow
{
    private $rowCount = 0;
    private $encounteredic_numbers = [];


    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $this->rowCount++;

        // if (students::where('name', $row[0])->exists()) {
        //     abort(422, 'row ' . $this->rowCount . ': Duplicate data found.');

        // }



        $ic_number = $row[1];

        // Check for duplicate IC numbers
        if (in_array($ic_number, $this->encounteredic_numbers)) {
            abort(400, 'Cannot have the same IC Number in the excel.');
        }

        // Add the current IC number to the encountered array
        $this->encounteredic_numbers[] = $ic_number;

        if(students::where('email', $row[3])->exists() )
        {
            abort(422, 'row ' . $this->rowCount . ': Duplicate email found.');
        }

        if(students::where('ic_number', $row[1])->exists() )
        {
            abort(422, 'row ' . $this->rowCount . ': Duplicate Ic Number found.');
        }

        if( strlen($row[1]) !== 12)
        {
            abort(422, 'row ' . $this->rowCount . ': ic must be 12digit.');
        }
        if ((strlen($row[2]) !== 10) && (strlen($row[2]) !== 11)){
            abort(422, 'row ' . $this->rowCount . ': phone number must be 10-11 digit.');
        }
        // Perform existence check for class_room_id
        if (!class_room::where('class_room_id', $row[6])->exists()) {
            abort(422, 'row ' . $this->rowCount . ': Invalid class_room_id.');
        }


        // amal said : please add validation for letter and number too

        // If all checks pass, create a new students model
        return new students([
            'name' => (string) $row[0],
            'ic_number' => (string) $row[1],
            'no_tell' => (string) $row[2],
            'email' => (string) $row[3],
            'family_income ' => (float) $row[4],
            'total_family_member' => (int) $row[5],
            'class_room_id' => (string) $row[6],
        ]);
    }
    public function startRow(): int
    {
        return 2; // Start reading from row 2
    }
}

