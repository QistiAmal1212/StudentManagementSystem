<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
class studentResult extends Model
{
    use HasFactory;
    protected $table = 'student_result';
    protected $primaryKey = 'result_id';
    use HasUuids;
}
