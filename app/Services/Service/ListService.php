<?php

namespace App\Services\Service;

use App\Models\Service;
use App\Services\BaseServiceInterface;


class ListService implements BaseServiceInterface
{
    protected $post_id;

    public function __construct($post_id)
    {
        $this->post_id = $post_id;
    }

    public function run()
    {
       
            return Service::latest()->get();
        
    }
}