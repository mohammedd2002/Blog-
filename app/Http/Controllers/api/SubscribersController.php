<?php

namespace App\Http\Controllers\api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscribersController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $subscribers = Subscriber::get();
        if (count($subscribers)>0) {
            return ApiResponse::sendResponse(200 , 'Subscribers Retrieved Successfully' , $subscribers );
        }
        return ApiResponse::sendResponse(200 , 'Subscribers Is Empty' , [] );

    }
}
