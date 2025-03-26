<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
class students extends Model
{
    use HasFactory;
    protected $table = 'students';
    protected $primaryKey = 'studentId';
    protected $fillable = [
        'name',
        'icNumber',
        'noTell',
        'email',
        'family_income ',
        'total_family_member',
        'race',
        'classroomId',
    ];
    use HasUuids;
}
