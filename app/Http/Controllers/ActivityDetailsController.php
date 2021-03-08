<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActivityDetails\StoreRequest;
use App\Services\ActivityDetails\CreateService;
use App\Services\Activity\InfoService;
use App\Http\Resources\ActivityResource;

class ActivityDetailsController extends Controller
{
    
    public function create(StoreRequest $request)
    {
        $validated = $request->validated();

        try {
            $new_activity = (new CreateService($validated))->run();
            $client_resource = new ActivityResource((new InfoService($new_activity))->run());
        } catch (\Exception $exception) {
            \Log::error($exception->getMessage());
            return response()->json(['status' => false, 'mesage' => 'Error processing request - '.$exception->getMessage(), 'data' => $exception], 500);
        }
        return response()->json(['status' => true, 'message' => 'New item(s) added to activity', 'data' =>  $client_resource], 201);

    }


    
}
