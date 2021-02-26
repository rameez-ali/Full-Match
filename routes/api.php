<?php

use App\Http\Controllers\Api\ApiNotificationController;
use App\Http\Controllers\Api\ApiOrderController;
use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\HomePageLayoutController;
use App\Http\Controllers\Api\MyListController;
use App\Http\Controllers\Api\PageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\ClubController;
use App\Http\Controllers\Api\HomeSliderBannerController;
use App\Http\Controllers\Api\PlayerController;
use App\Http\Controllers\Api\LeagueController;
use App\Http\Controllers\Api\VideoController;
use App\Http\Controllers\Api\SubsPlanController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\SearchSuggestionController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\LeagueSeasonController;
use App\Http\Controllers\Api\ContinueWatchedController;
use App\Http\Controllers\Api\WishController;
use Laravel\Socialite\Facades\Socialite;

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
Auth::routes(['verify' => true]);


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/allcustomers', [CustomerController::class , 'index']);

Route::get('/clubs', [ClubController::class , 'clubs']);
Route::get('/club/{id}', [ClubController::class , 'club']);
Route::get('/clubsearch/{string}', [SearchController::class , 'searchclub']);

Route::get('/players', [PlayerController::class , 'players']);
Route::get('/player/{id}', [PlayerController::class , 'player']);
Route::get('/playersearch/{string}', [SearchController::class , 'searchplayer']);

Route::get('/leagues', [LeagueController::class , 'leagues']);
Route::get('/league/{id}', [LeagueController::class , 'league']);

Route::get('/customer/{id}', [CustomerController::class , 'show']);

Route::get('/allsubsplans', [SubsPlanController::class , 'index']);

Route::get('/videos', [VideoController::class , 'videos']);
Route::get('/video/{id}', [VideoController::class , 'video_details']);

Route::post('/contact', [ContactController::class , 'contact']);

Route::get('/contact', [ContactController::class , 'contact']);
Route::post('/query', [ContactController::class , 'query']);

Route::post('/leagueseason/{league_id}/{season_id}', [LeagueSeasonController::class , 'season']);


Route::get('/forcurrency', [ApiOrderController::class , 'getCurrency']);


Route::get('/page/{id}', [PageController::class , 'cmsPage']);

Route::get('/homepg-layout', [HomePageLayoutController::class , 'index']);

//Customer Auth Routes
Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', [ApiAuthController::class , 'login']);
    Route::post('socialLogin', [ApiAuthController::class , 'socialLogin']);
    Route::post('signup', [ApiAuthController::class , 'signup']);

//    Route::get('/google-redirect', [ApiAuthController::class , 'googleRedirect']);
//    Route::get('/google-callback', [ApiAuthController::class , 'googlecCallback']);
//just put these routes and functions
//    Route::get('/facebook-redirect', [ApiAuthController::class , 'facebookRedirect']);
//    Route::get('/facebook-callback', [ApiAuthController::class , 'facebookCallback']);
//
//    Route::get('/apple-redirect', [ApiAuthController::class , 'appleRedirect']);
//    Route::get('/apple-callback', [ApiAuthController::class , 'appleCallback']);

});

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('user', [ApiAuthController::class , 'user']);
    Route::get('/notify-off', [ApiNotificationController::class , 'notifiOff']);
    Route::get('/notify-on', [ApiNotificationController::class , 'notifiOn']);
    Route::get('/add-to-mylist/{id}', [MyListController::class , 'addToMylist']);
    Route::get('/remove-to-mylist/{id}', [MyListController::class , 'removeToMylist']);
    Route::get('/all-mylist', [MyListController::class , 'getAllMylist']);
    Route::get('/getcontinuewatched', [ContinuewatchedController::class , 'getcontinuewatch']);
    Route::get('logout', [ApiAuthController::class , 'logout']);
    Route::post('/customer-edit', [CustomerController::class , 'edit']);
    Route::post('/continuewatched', [ContinuewatchedController::class , 'continuewatch']);
    Route::post('/customer-update/{id}', [CustomerController::class , 'update'])->name('customer.profupdate');
});
Route::post('/initalToken', [CustomerController::class , 'initalToken']);

Route::post('fogetpass', [CustomerController::class , 'forgotpass']);
//Customer Auth Routes

Route::get('/search/{string}', [SearchController::class , 'search']);
Route::get('/searchsuggestion/{string}', [SearchSuggestionController::class , 'searchsuggestion']);

Route::get('/videouserid', [WishController::class , 'wishlist']);


Route::get('/category/{id}', [CategoryController::class , 'getcategoryinfo']);
Route::post('/categoryinfo/{category_id}/{genre_id}', [CategoryController::class , 'getcategorygenreinfo']);
Route::get('/homesliderbanner', [HomeSliderBannerController::class , 'getsliderbanner']);

Route::get('/searchclub/{string}', [SearchController::class , 'searchclub']);
Route::get('/searchplayer/{string}', [SearchController::class , 'searchplayer']);

//Route::get('/category', [CategoryController::class , 'gethomepageinfo1']);

