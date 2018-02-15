<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'accommodation',
        'traveller',
        'checkinDate',
        'checkoutDate',
        'checkinHour',
        'checkoutHour',
        'checkinDetails',
        'checkoutDetails',
        'nbNights',
        'nbPersons',
        'isBooked',
        'description',
        'isActive'
    ];
}
