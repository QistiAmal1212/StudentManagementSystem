<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    protected $table = 'Classroom';
    protected $primaryKey = 'Classroom_id';
    protected $fillable = [
        'class_name',
        'form',
        'teacher_id',
    ];
    use HasFactory;
    use HasUuids;
}
