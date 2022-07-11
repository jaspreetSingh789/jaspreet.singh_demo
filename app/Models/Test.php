<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use Sluggable;
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'duration',
        'pass_percentage',
        'total_questions'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'test_question', 'test_id', 'question_id');
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'id', 'lessonable_id');
    }
}
