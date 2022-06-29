<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    use Sluggable;

    protected $fillable = ['name', 'slug', 'user_id', 'status'];

    const ACTIVE = 1;
    const INACTIVE = 0;


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['sort_by'] ?? false, function ($query, $sort_by) {

            if ($sort_by == 'A-Z') {
                $query->orderBy('name', 'ASC');
            } elseif ($sort_by == 'Z-A') {
                $query->orderBy('name', 'DESC');
            } else {
                $query->orderBy('created_at', $sort_by);
            }
        });

        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%');
        });
    }
}
