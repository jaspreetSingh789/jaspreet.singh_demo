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

    // constants
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


    // Attributes
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getIsEmployeeAttribute()
    {
        return $this->attributes['role_id'] == Role::EMPLOYEE;
    }

    // Relationships
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

    public function assignedUsers()
    {
        return $this->belongsToMany(User::class, 'teams', 'team_id', 'user_id')
            ->withTimestamps();
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_user', 'user_id', 'course_id');
    }

    public function trainerCourses()
    {
        return $this->belongsToMany(Course::class, 'team_course', 'user_id', 'course_id');
    }

    public function enrollments()
    {
        return $this->belongsToMany(Course::class)
            ->withPivot('id', 'status', 'completed_percentage')
            ->using(CourseUser::class)
            ->withTimestamps();
    }

    // Scopes
    public function scopeUsersList($query)
    {
        return  $query->where('created_by', Auth::id())
            ->Where('role_id', '!=', Role::ADMIN);
    }

    public function scopeFilter($query, array $filters)
    {

        $query->when($filters['user_type'] ?? false, function ($query, $user_type) {
            $query->where('role_id', $user_type);
        });

        $query->when($filters['date_filter'] ?? false, function ($query, $date_filter) {

            if ($date_filter == 'A-Z') {
                $query->orderBy('first_name', 'ASC');
            } elseif ($date_filter == 'Z-A') {
                $query->orderBy('first_name', 'DESC');
            } else {
                $query->orderBy('created_at', $date_filter);
            }
        });

        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where('first_name', 'like', '%' . $search . '%')
                ->orwhere('email', 'like', '%' . $search . '%');
        });
    }

    public function scopeVisibleTo($query)
    {
        if (Auth::id() == Role::ADMIN) {
            return $query->where('role_id', '>', Auth::user()->role_id);
        } else {
            return $query->where('role_id', '>', Auth::user()->role_id)
                ->where('created_by', Auth::id())
                ->orWhereHas('trainers', function ($query) {
                    return $query->where('team_id', Auth::id());
                });
        }
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

    public function scopeEnrolledUsers($query)
    {
        $query->where('role_id', Role::EMPLOYEE)
            ->Orwhere('role_id', Role::TRAINER);
    }
}
