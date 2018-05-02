<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{

    protected $table = "accommodation";

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

    public function getId() {
        return $this->id;
    }

}
