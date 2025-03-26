<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class class_room extends Model
{
    protected $table = 'class_room';
    protected $primaryKey = 'class_room_id';
    protected $fillable = [
        'class_name',
        'form',
        'teacher_id',
    ];
    use HasFactory;
    use HasUuids;
}
