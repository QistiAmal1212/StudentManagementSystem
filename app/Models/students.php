<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
class Students extends Model
{
    use HasFactory;
    protected $table = 'students';
    protected $primaryKey = 'student_id';
    protected $fillable = [
        'name',
        'ic_number',
        'no_tell',
        'email',
        'family_income',
        'total_family_member',
        'race',
        'classroom_id',
    ];
    use HasUuids;
}
