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
        'username',
        'password',
        'lastName',
        'firstName',
        'languages',
        'skills',
        'isActive',
        'roles'
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
}
