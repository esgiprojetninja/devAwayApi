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

    public function travellers() {
        return $this->hasMany('App\Candidate');
    }

    public function accommodation() {
        return $this->belongsTo('App\Accommodation', 'accommodation_id', 'id');
    }

    public function candidate()
    {
        return $this->hasOne('App\Candidate');
    }

    public function pictures()
    {
        return $this->hasMany('App\PictureMission');
    }

}
