<?php

use App\Http\Controllers\Api\ApiNotificationController;
use App\Http\Controllers\Api\ApiOrderController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\ClubController;
use App\Http\Controllers\Api\PlayerController;
use App\Http\Controllers\Api\VideoController;
use App\Http\Controllers\Api\SubsPlanController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\CategoryController;

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

Route::get('/clubs', [ClubController::class , 'clubs']);
Route::get('/club/{id}', [ClubController::class , 'club']);

Route::get('/players', [PlayerController::class , 'players']);
Route::get('/player/{id}', [PlayerController::class , 'player']);

Route::get('/customer/{id}', [CustomerController::class , 'show']);

Route::get('/allsubsplans', [SubsPlanController::class , 'index']);

Route::get('/videos', [VideoController::class , 'videos']);
Route::get('/video/{id}', [VideoController::class , 'video_details']);

Route::post('/contact', [ContactController::class , 'contact']);

Route::get('/contact', [ContactController::class , 'contact']);
Route::post('/query', [ContactController::class , 'query']);

Route::get('/forcurrency', [ApiOrderController::class , 'getCurrency']);

Route::get('/notify-off', [ApiNotificationController::class , 'notifiOff']);

//Customer Auth Routes
Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', [AuthController::class , 'login']);
    Route::post('signup', [AuthController::class , 'signup']);

    Route::group([
        'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', [AuthController::class , 'logout']);
        Route::get('user', [AuthController::class , 'user']);
    });
});
//Customer Auth Routes

Route::get('/search/{string}', [SearchController::class , 'search']);

Route::get('/category', [CategoryController::class , 'category']);
Route::get('/getgenre/{id}', [CategoryController::class , 'getgenre']);
