<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
class Exam extends Model
{
    use HasFactory;
    protected $table = 'exam';
    protected $primaryKey = 'exam_id';
    use HasUuids;
}
