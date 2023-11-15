<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class documents extends Model
{
    protected $table = 'document';
    protected $primaryKey = 'documentId';
    protected $fillable = [
        'documentPath',
        'title',
      
    ];
    use HasFactory;
}
