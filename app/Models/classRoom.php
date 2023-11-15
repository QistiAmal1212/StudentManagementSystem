<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class classRoom extends Model
{
    protected $table = 'classRoom';
    protected $primaryKey = 'classroomId';
    protected $fillable = [
        'className',
        'form',
        'teacherId',
    ];
    use HasFactory;
    use HasUuids;
}
