<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = "user";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'email',
        'roles',
        'userName',
        'password',
        'lastName',
        'firstName',
        'languages',
        'skills',
        'isActive',
        'avatar',
        'city',
        'country'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    public function getId() {
        return $this->id;
    }

    public function getRoles() {
        return $this->roles;
    }

    public function accommodations()
    {
        return $this->hasMany('App\Accommodation');
    }

    public function candidates()
    {
        return $this->hasMany('App\Candidate');
    }

    public function messages()
    {
        return $this->hasMany('App\Messages');
    }
}
