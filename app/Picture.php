<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{

    protected $table = "picture";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'url',
        'accommodationId'
    ];

    public function getId() {
        return $this->id;
    }

    public function accommodations() {
        return $this->belongsTo('App\Accommodation', 'picture_accommodation_id_foreign');
    }

    public function setAccommodationId($id) {
        $this->accommodationId = $id;
    }

    public function setUrl($url) {
        $this->url = $url;
    }

}
