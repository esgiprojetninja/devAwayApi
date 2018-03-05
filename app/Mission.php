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

}
