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

    public function getId() {
        return $this->id;
    }

    public function messages()
    {
        return $this->hasMany('App\Messages');
    }

    public function traveller() {
        return $this->belongsTo('App\User', 'traveller', 'id');
    }

}
