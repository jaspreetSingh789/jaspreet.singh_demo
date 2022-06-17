<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $fillable = [
        'name',
        'slug'
    ];

    const ADMIN = 1;
    const SUB_ADMIN = 2;
    const TRAINER = 3;
    const EMPLOYEE = 4;

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
