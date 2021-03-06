<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{

    protected $table = "candidate";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'user',
        'mission_id',
        'fromDate',
        'toDate',
        'status'
    ];

    public function getId() {
        return $this->id;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function setMissionId($mission)
    {
        $this->mission_id = $mission;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setFromDate($fromDate)
    {
        $this->fromDate = $fromDate;
    }

    public function setToDate($toDate)
    {
        $this->toDate = $toDate;
    }

    public function user() {
        return $this->belongsTo('App\User', 'user', 'id');
    }

    public function missions() {
        return $this->belongsTo('App\Mission', 'mission_id', 'id');
    }
}
