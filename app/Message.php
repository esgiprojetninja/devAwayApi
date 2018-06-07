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
        'mission',
        'candidate',
    ];

    public function getId() {
        return $this->id;
    }

    public function candidate() {
        return $this->hasMany('App\Candidate', 'id', 'candidate');
    }

    public function mission() {
        return $this->hasMany('App\Mission', 'id', 'mission');
    }
}
