<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{

    protected $table = "candidate";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'user',
        'accommodation',
        'fromDate',
        'toDate',
        'status'
    ];

}
