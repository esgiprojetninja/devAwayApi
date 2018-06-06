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

}
