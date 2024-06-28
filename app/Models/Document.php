<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $table = 'document';

    protected $fillable = [
        'title',
        'date',
        'author',
        'type',
        'status',
        'location',
        'user_id',
    ];
}
