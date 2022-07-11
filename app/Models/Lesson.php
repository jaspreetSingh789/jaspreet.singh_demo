<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Lesson extends Model
{
    use Sluggable;
    use HasFactory;

    protected $fillable = [
        'name',
        'unit_id',
        'slug',
        'lessonable_type',
        'lessonable_id',
        'sort_order',
        'duration',
        'skipable'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function lessonable()
    {

        return $this->morphTo();
    }

    // relations

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
