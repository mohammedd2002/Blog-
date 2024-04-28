<?php

namespace App\Http\Controllers\api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CatrgoryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $category = Category::get();
        if (count($category)>0)
        {
            return ApiResponse::sendResponse(200 , 'Category Retrieved Successfully' , CategoryResource::collection($category));
        }
        return ApiResponse::sendResponse(200 , 'Category is Empty' , []);
    }
}
