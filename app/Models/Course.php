<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;
    use Sluggable;

    protected $fillable = [
        'title',
        'description',
        'certificate',
        'user_id',
        'category_id',
        'level_id'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /** Relationships */

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function enrolledUsers()
    {
        return $this->belongsToMany(User::class, 'course_user', 'course_id', 'user_id');
    }

    public function units()
    {
        return $this->belongsToMany(Unit::class, 'course_unit', 'course_id', 'unit_id');
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function image()
    {
        return $this->hasOne(Image::class);
    }

    /* Scope's */
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['category'] ?? false, function ($query, $category_id) {
            $query->where('category_id', $category_id);
        });


        $query->when($filters['level'] ?? false, function ($query, $level_id) {
            $query->where('level_id', $level_id);
        });

        $query->when($filters['sort_by'] ?? false, function ($query, $sort_by) {

            if ($sort_by == 'A-Z') {
                $query->orderBy('title', 'ASC');
            } elseif ($sort_by == 'Z-A') {
                $query->orderBy('title', 'DESC');
            } else {
                $query->orderBy('created_at', $sort_by);
            }
        });

        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where('title', 'like', '%' . $search . '%')
                ->orwhere('description', 'like', '%' . $search . '%');
        });
    }

    /** Attributes */
}
