<?php

namespace App\Http\Controllers;

use App\Http\Requests\Activities\StoreRequest;
use App\Http\Requests\Service\ListRequest;
use App\Http\Resources\ActivityCollection;
use App\Http\Resources\ActivityResource;
use App\Services\Activity\CreateService;
use App\Services\Activity\InfoService;
use App\Services\Activity\ListService;

class ActivityController extends Controller
{
    
    public function create(StoreRequest $request)
    {
        $validated = $request->validated();

        try {
            $new_activity = (new CreateService($validated))->run();
            $client_resource = new ActivityResource((new InfoService($new_activity->id))->run());
        } catch (\Exception $exception) {
            \Log::error($exception->getMessage());
            return response()->json(['status' => false, 'mesage' => 'Error processing request - '.$exception->getMessage(), 'data' => $exception], 500);
        }
        return response()->json(['status' => true, 'message' => 'New Activity created', 'data' =>  $client_resource], 201);

    }

    public function get(ListRequest $request)
    {
        $validated = $request->validated();
        try {
            $client_collection = (new ListService($validated))->run();
        } catch (\Exception $exception) {
            \Log::error($exception->getMessage());
            return response()->json(['status' => false, 'mesage' => 'Error processing request '.$exception->getMessage(), 'data' => $exception], 500);
        }
        return response()->json(['status' => true, 'message' => 'List of activities', 'data' =>  $client_collection], 200);
    }


    public function show($id){
        try {
           $activity_resource = new ActivityResource((new InfoService($id))->run());
        } catch (\Exception $exception) {
            \Log::error($exception->getMessage());
            return response()->json(['status' => false, 'mesage' => 'Error processing request - '.$exception->getMessage(), 'data' => $exception], $exception->getCode());
        }
        return response()->json(['status' => true, 'message' => 'showing Activity details', 'data' =>  $activity_resource,], 200);
    }
    
}
