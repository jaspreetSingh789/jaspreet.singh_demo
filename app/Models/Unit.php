<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Unit extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    protected $fillable = ['title', 'description'];

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
}
