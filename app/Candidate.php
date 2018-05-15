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
        'mission',
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

    public function setMission($mission)
    {
        $this->mission = $mission;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function setFromDate($fromDate)
    {
        $this->fromDate = $fromDate;
    }
    public function setToDate($toDate)
    {
        $this->toDate = $toDate;
    }
}
