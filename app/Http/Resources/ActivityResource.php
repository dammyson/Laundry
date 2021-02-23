<?php

namespace App\Http\Resources;

use App\Models\Service;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class ActivityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' =>  $this->id,
            'first_name' =>  $this->first_name,
            'last_name' =>  $this->last_name,
            'email' =>  $this->email,
            'phone_number' =>  $this->phone_number,
            'address' =>  $this->address,
            'type' =>  $this->type,
            'pickup_time' =>  $this->pickup_time,
            'details' =>  $this->details,
            'total_cost' => $this->getTotalCost($this),
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }


    public function getTotalCost($data)
    {
        $total = 0;
        $services_id = Arr::pluck($this->details, 'service_id');
        $users = Service::whereIn('id', $services_id)->get();
        $collection = collect($users);
        $grouped = $collection->groupBy('id');
       
        if ($this->type == 'REGULAR') {
            foreach ($this->details as $detail) {
                if($detail->service_category == "WASH"){
                   $service = $grouped[$detail->service_id];
                   $amount= $detail->quantity * $service[0]['washing_price'];
                    $total = $total + $amount;
                }else if($detail->service_category == "IRON"){
                    $service = $grouped[$detail->service_id];
                    $amount= $detail->quantity * $service[0]['ironing_price'];
                     $total = $total + $amount;
                }else if($detail->service_category == "CLEAN"){
                    $service = $grouped[$detail->service_id];
                    $amount= $detail->quantity * $service[0]['cleaning_price'];
                     $total = $total + $amount;
                }
            }
        } else {
            foreach ($this->details as $detail) {
                if($detail->service_category == "WASH"){
                   $service = $grouped[$detail->service_id];
                   $amount= $detail->quantity * $service[0]['exp_washing_price'];
                    $total = $total + $amount;
                }else if($detail->service_category == "IRON"){
                    $service = $grouped[$detail->service_id];
                    $amount= $detail->quantity * $service[0]['exp_ironing_price'];
                     $total = $total + $amount;
                }else if($detail->service_category == "CLEAN"){
                    $service = $grouped[$detail->service_id];
                    $amount= $detail->quantity * $service[0]['exp_cleaning_price'];
                     $total = $total + $amount;
                }
            }
        }

        return $total;
    }
}
