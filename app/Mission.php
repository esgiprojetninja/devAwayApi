<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{

    protected $table = "mission";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
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
        'isActive',
        'title',
        'accommodation_id'
    ];

    public function getId() {
        return $this->id;
    }

    public function traveller() {
        return $this->belongsTo('App\User', 'traveller', 'id');
    }

    public function accommodation() {
        return $this->belongsTo('App\Accommodation', 'picture_accommodation_id_foreign');
    }

    public function candidate()
    {
        return $this->hasOne('App\Candidate');
    }

}
