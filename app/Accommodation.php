<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'title',
        'description',
        'city',
        'region',
        'country',
        'address',
        'longitude',
        'latitude',
        'pictures',
        'host',
        'nbBedroom',
        'nbBathroom',
        'nbToilet',
        'nbMaxBaby',
        'nbMaxChild',
        'nbMaxGuest',
        'nbMaxAdult',
        'animalsAllowed',
        'smokersAllowed',
        'hasInternet',
        'propertySize',
        'floor',
        'minStay',
        'maxStay',
        'type',
        'checkinHour',
        'checkoutHour'
    ];

}
