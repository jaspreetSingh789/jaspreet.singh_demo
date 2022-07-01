<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseUnit extends Model
{
    use HasFactory;

    protected $table = 'course_unit';

    protected $fillable = [
        'course_id',
        'unit_id',
        'sort_order'
    ];
}
