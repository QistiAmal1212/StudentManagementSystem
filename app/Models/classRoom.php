<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class classroom extends Model
{
    protected $table = 'classroom';
    protected $primaryKey = 'classroom_id';
    protected $fillable = [
        'class_name',
        'form',
        'teacher_id',
    ];
    use HasFactory;
    use HasUuids;
}
