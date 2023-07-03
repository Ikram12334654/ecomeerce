<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CrudOPration;
use Mockery\HigherOrderMessage;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

    Route::post('/register',[AuthController::class,'register']);
    Route::post('/login',[AuthController::class,'login']);
   

    Route::middleware('auth')->group( function ()  
    {
        Route::post('/create',[CrudOPration::class,'create'])->name('createproduct');
        Route::post('/update',[CrudOPration::class,'update'])->name('updateproduct');
        Route::post('/delete',[CrudOPration::class,'delete'])->name('deleteproduct');
        Route::get('/index',[CrudOPration::class,'view'])->name('viewproduct');
    });
Route::middleware('auth:api')->group( function ()  
{
    Route::post('/logout',[AuthController::class,'logout'])->name('logout');
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



