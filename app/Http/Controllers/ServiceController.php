<?php

namespace App\Http\Controllers;

use App\Http\Requests\Service\ListRequest;
use App\Http\Resources\ServiceCollection;
use App\Services\Service\ListService;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function get(ListRequest $request)
    {

        $validated = $request->validated();
        try {
            $service_collection = new ServiceCollection((new ListService($validated))->run());
        } catch (\Exception $exception) {
            \Log::error($exception->getMessage());
            return response()->json(['status' => false, 'mesage' => 'Error processing request '.$exception->getMessage(), 'data' => $exception], 500);
        }
        return response()->json(['status' => true, 'message' => 'List of service', 'data' =>  $service_collection], 200);
       
    }
}
