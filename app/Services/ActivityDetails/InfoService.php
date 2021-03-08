<?php

namespace App\Services\Activity;

use App\Models\Activity;
use App\Services\BaseServiceInterface;


class InfoService implements BaseServiceInterface
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function run()
    {
       $activities = Activity::with('details')->findorfail($this->id);
       return $activities; 
    }
}