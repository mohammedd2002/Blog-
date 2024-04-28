<?php

namespace App\Http\Controllers\api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactRequest;
use App\Http\Resources\contactResource;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreContactRequest $request)
    {
       $data = $request->validated();
       $store = Contact::create($data);
       if ($store) {
        return ApiResponse::sendResponse(201 , 'Sent Successfully' ,[]);
       }
    }
}
