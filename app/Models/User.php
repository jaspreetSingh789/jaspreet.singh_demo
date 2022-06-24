<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    use Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'first_name',
        'last_name',
        'role_id',
        'email',
        'email_status',
        'status',
        'password',
        'created_by'
    ];

    protected $guarded = [];

    const ACTIVE = 1;
    const INACTIVE = 0;


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'first_name'
            ]
        ];
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeUsersList($query)
    {
        return  $query->where('created_by', Auth::id())
            ->Where('role_id', '!=', Role::ADMIN);
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function trainers()
    {
        return $this->belongsTomany(User::class, 'teams', 'user_id', 'team_id')
            ->withTimestamps();
    }

    public function employees()
    {
        return $this->belongsTomany(User::class, 'teams', 'team_id', 'user_id');
    }

    public function assignedUsers()
    {
        return $this->belongsToMany(User::class, 'teams', 'team_id', 'user_id')
            ->withTimestamps();
    }

    public function scopeVisibleTo($query)
    {
        if (Auth::id() == Role::ADMIN) {
            return $query->where('role_id', '>', Auth::user()->role_id);
        } else {
            return $query->where('role_id', '>', Auth::user()->role_id)
                ->where('created_by', Auth::id());
        }
        // $query->where('id', '!=', Auth::id());
    }

    public function scopeCreatedByAdmin($query)
    {
        $query->where('created_by', Role::ADMIN);
    }

    public function scopeEmployee($query)
    {
        $query->where('role_id', Role::EMPLOYEE);
    }

    public function scopeTrainer($query)
    {
        $query->where('role_id', Role::TRAINER);
    }

    public function scopeActive($query)
    {
        $query->where('status', User::ACTIVE);
    }
}
