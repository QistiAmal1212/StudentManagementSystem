<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
class StudentResult extends Model
{
    use HasFactory;
    protected $table = 'student_result';
    protected $primaryKey = 'result_id';
    use HasUuids;
}
