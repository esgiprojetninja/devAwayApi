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
        'country',
        'emailVerified',
        'addressVerified',
        'emailVerifiedToken'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    public function getId() {
        return $this->id;
    }

    public function getRoles() {
        return $this->roles;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmailVerified($bool)
    {
        $this->emailVerified = $bool;
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
