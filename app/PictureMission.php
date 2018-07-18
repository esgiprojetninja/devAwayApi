<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PictureMission extends Model
{

    protected $table = "picture_mission";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'url',
        'mission_id'
    ];

    public function getId() {
        return $this->id;
    }

    public function getMissionId()
    {
        return $this->mission_id;
    }

    public function mission() {
        return $this->belongsTo('App\Mission', 'picture_mission_mission_id_foreign');
    }

    public function setMissionId($id) {
        $this->mission_id = $id;
    }

    public function setUrl($url) {
        $this->url = $url;
    }

}
