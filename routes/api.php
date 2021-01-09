<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\http\Controllers\Api\CustomerController;
use App\http\Controllers\Api\SubsPlanController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/allcustomers', [CustomerController::class , 'index']);

Route::get('/customer/{id}', [CustomerController::class , 'show']);

Route::get('/allsubsplans', [SubsPlanController::class , 'index']);
