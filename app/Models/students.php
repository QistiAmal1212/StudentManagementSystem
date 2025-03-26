<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
class students extends Model
{
    use HasFactory;
    protected $table = 'students';
    protected $primaryKey = 'student_id';
    protected $fillable = [
        'name',
        'ic_number',
        'no_tell',
        'email',
        'family_income ',
        'total_family_member',
        'race',
        'Classroom_id',
    ];
    use HasUuids;
}
