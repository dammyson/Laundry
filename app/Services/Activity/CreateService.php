<?php

namespace App\Services\Activity;

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
            $new_activity = Activity::create([
                'user_id' => '1ee6ea7a-33fd-4acb-9c05-4c67dc6815c7',
                'first_name' => $this->data['first_name'],
                'last_name' => $this->data['last_name'],
                'email' => $this->data['email'],
                'phone_number' => $this->data['phone_number'],
                'address' => $this->data['address'],
                'type' => $this->data['type'],
                'pickup_time' => $this->data['pickup_time'],
                
            ]);
            $this->createDetails($new_activity->id);
            return $new_activity;
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
