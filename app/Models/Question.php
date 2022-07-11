<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Question extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'name',
        'slug',
        'file_id',
        'type'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function questionOptions()
    {
        return $this->hasMany(QuestionOption::class);
    }

    public function tests()
    {
        return $this->belongsToMany(Test::class, 'test_question', 'test_id', 'question_id');
    }
}
