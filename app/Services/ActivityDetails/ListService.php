<?php

namespace App\Services\Activity;

use App\Models\Activity;
use App\Models\Post;
use App\Services\BaseServiceInterface;


class ListService implements BaseServiceInterface
{
    protected $product_id;

    public function __construct($product_id)
    {
        $this->product_id = $product_id;
    }

    public function run()
    {
            return Activity::latest()->get();
    }
}