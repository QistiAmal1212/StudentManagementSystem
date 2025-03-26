<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
class Classroom_teacher extends Model
{
    protected $table = 'Classroom_teacher';
    protected $primaryKey = 'teacher_id';
    protected $fillable = [

        'name',
        'ic_number',
        'no_tell',
        'email',
    ];
    use HasFactory;
    use HasUuids;
}
