<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;




class User extends Authenticatable implements MustVerifyEmail
{
    use  HasFactory, Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'user_id',
        'password',
        'email_address',
        'last_login_at',
        'business_unit',
        'roles',
        'Last_login',
        'Checklist_permission',
        'Profile_Photo'
    ];

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
        'roles' => 'array',
        'Checklist_permission' => 'array',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array<string>
     */
    protected $dates = [
        'last_login_at',
    ];

    /**
     * Get the user's ID.
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    public function getRoleAttribute()
{
    return $this->attributes['roles'];
}

    /**
     * Get the user's name.
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Determine if the user is an administrator.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->roles()->where('id', 1)->exists();
    }

    /**
     * Get the roles that belong to the user.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }


    /**
     * Get the formatted email verified at date.
     *
     * @param  \DateTimeInterface|null  $value
     * @return string|null
     */
    public function getEmailVerifiedAtAttribute($value)
    {
        return $value ? $value->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    /**
     * Set the email verified at attribute.
     *
     * @param  string|null  $value
     * @return void
     */
}
