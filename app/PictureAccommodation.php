<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PictureAccommodation extends Model
{

    protected $table = "picture_accommodation";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'url',
        'accommodation_id'
    ];

    public function getId() {
        return $this->id;
    }

    public function accommodations() {
        return $this->belongsTo('App\Accommodation', 'picture_accommodation_accommodation_id_foreign');
    }

    public function setAccommodationId($id) {
        $this->accommodation_id = $id;
    }

    public function setUrl($url) {
        $this->url = $url;
    }

}
