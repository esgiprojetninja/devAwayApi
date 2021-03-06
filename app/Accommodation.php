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
        'checkoutHour',
        'user_id'
    ];

    public function getId() {
        return $this->id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    /**
     * Get all of the posts for the country.
     */
    public function pictures()
    {
        return $this->hasMany('App\PictureAccommodation');
    }

    public function host() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function missions()
    {
        return $this->hasMany('App\Mission');
    }
}
