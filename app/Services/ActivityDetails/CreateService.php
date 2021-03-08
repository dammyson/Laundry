<?php

namespace App\Services\ActivityDetails;

use App\Models\Activity;
use App\Models\ActivityDetail;
use App\Services\BaseServiceInterface;

class CreateService implements BaseServiceInterface
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function run()
    {
        return \DB::transaction(function () {
            $this->createDetails($this->data['activity_id']);
            return $this->data['activity_id'];
        });
    }


    public function createDetails($activity_id)
    {
            if (\Arr::has($this->data, 'details')) {
                foreach ($this->data['details'] as $detail) {
                    ActivityDetail::create([
                        'activity_id' => $activity_id,
                        'service_id' => $detail['service_id'],
                        'service_category' => $detail['service_category'],
                        'quantity' => $detail['quantity'],
                
                    ]);
                }
            }

            return true;
    }   
}
