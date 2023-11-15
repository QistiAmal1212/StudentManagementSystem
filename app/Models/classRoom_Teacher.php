<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
class classRoom_Teacher extends Model
{
    protected $table = 'classRoom_Teacher';
    protected $primaryKey = 'teacherId';
    protected $fillable = [
        
        'name',
        'icNumber',
        'noTell',
        'email',
    ];
    use HasFactory;
    use HasUuids;
}
