<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class documents extends Model
{
    protected $table = 'document';
    protected $primaryKey = 'document_id';
    protected $fillable = [
        'document_path',
        'title',

    ];
    use HasFactory;
}
