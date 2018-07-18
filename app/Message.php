<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    protected $table = "message";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'content',
        'from',
        'to',
    ];

    public function getId() {
        return $this->id;
    }

    public function from() {
        return $this->hasOne('App\User', 'id', 'from');
    }

    public function to() {
        return $this->hasOne('App\User', 'id', 'to');
    }
}
