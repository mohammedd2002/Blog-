<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\BlogsController;
use App\Http\Controllers\api\CatrgoryController;
use App\Http\Controllers\api\CommentController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\api\ContactsController;
use App\Http\Controllers\api\SubscribersController;

/////AUTH/////////
Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login' ,'login');
    Route::post('/logout' , 'logout')->middleware('auth:sanctum');
});
//////CONTACTS///////
Route::post('/contacts', ContactsController::class);
//////COMMENTS///////
Route::get('/comments/{blog_id}', CommentController::class);
//////CATEGORY///////
Route::get('/category', CatrgoryController::class);
//////SUBSCRIBERS///////
Route::get('/subscribers' , SubscribersController::class );
/////BLOGS//////
Route::prefix('/blogs')->controller(BlogsController::class)->group(function(){
    Route::get('/','index');
    Route::get('/latest' , 'latest');
    Route::get('/category' , 'category');
    Route::get('/user' , 'user');
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/create' , 'create');
        Route::post('/update/{blogId}' , 'update');
        Route::get('/delete/{blogId}' , 'delete');
        Route::get('/myBlogs' , 'myBlogs');
    });

});


