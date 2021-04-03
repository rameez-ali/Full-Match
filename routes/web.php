<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('/welcome');
});
Route::get('page/{id}', 'PageController@show')->name('page.id');
Auth::routes(['verify' => true]);
Route::group(['middleware' => ['auth']], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('customer', 'CustomerController');
//    Route::resource('subscriptionplans','SubsPlanController');
//    Route::resource('discount','PromoCodeController');
    Route::resource('category-form','ProjectCategoryViewController');
    Route::resource('genre-form','ProjectGenreViewController');

    Route::resource('player-form','ProjectPlayerViewController');
    Route::resource('contact-form','ProjectContactViewController');
    Route::resource('club-form','ProjectClubViewController');

    Route::resource('league-form','ProjectLeagueViewController');
    Route::get('leaguedetails/{id}','ProjectLeagueViewController@league_details');

    Route::resource('Contactus-form','ContactUSController');

    Route::resource('video-form','ProjectVideoViewController');
    Route::get('video-form/seasons/{id}','ProjectVideoViewController@getseasons');
    // Route::get('video-form/{id}/seasons/{id}','ProjectVideoViewController@getseasonsedit');

    Route::post('video-form-search','VideoSearchController@search')->name('video-form-search.search');
    Route::get('video-form-search','ProjectVideoViewController@index')->name('video-form-search.search');
    Route::get('exportxls/{id}', 'ProjectVideoViewController@exportexcel');
    Route::get('exportcsv/{id}', 'ProjectVideoViewController@exportcsv');


    Route::resource('seasonpart-form','SeasonPartSorting');
    Route::get('get-state-list','SeasonPartSorting@get_seasons');
    Route::get('get-city-list','SeasonPartSorting@get_leagues_seasons_videos');

    Route::resource('subscriptionplans','SubsPlanController');
    Route::resource('notification','NotificationController');
    Route::get('notification-send/{id}','NotificationController@sendNotification')->name('notification.send');
    Route::resource('page', 'PageController')->only(['index','edit','update']);
    Route::get('videoclub/{id}','ProjectVideoViewController@destroy1');
    Route::get('videodetails/{id}','ProjectVideoViewController@video_details');

    Route::resource('slider-form','ProjectSliderViewController');
    Route::get('slider-form/allvideos/{id}','ProjectSliderViewController@getallvideos');
    Route::get('slider-form/videos/{id}','ProjectSliderViewController@getvideos');

    Route::get('slider/{id}','ProjectSliderViewController@slider_details');

    Route::resource('banner-form','ProjectAdvertisementViewController');
    Route::get('banner-form/allvideos/{id}','ProjectAdvertisementViewController@getallvideos');
    Route::get('banner-form/videos/{id}','ProjectAdvertisementViewController@getvideo');
    Route::get('adv_banner/{id}','ProjectAdvertisementViewController@destroy1');


    // Route::resource('my-form','SeasonPartSortingController');
    // Route::get("addmore","SeasonPartSortingController@addMore");
    // Route::post("addmore","SeasonPartSortingController@addMorePost");


    // Route::post("addmore","SeasonPartSortingController@addMorePost");
    Route::resource("home-page-manage","HomePageManageController");
    Route::get("new-adding-switch/{id}","HomePageManageController@newaddingtoggle");
    Route::post('discount/promo/verify','DiscountController@verify')->name('discount.promo.verify');

    Route::resource("user","UserRoleController");
    Route::resource("role","RoleController");
    Route::get('role/permissions/{id}', 'RoleController@permission')->name('role.permission');
    Route::post('role/permissions', 'RoleController@savePermissions')->name('save.role.permission');
    Route::get('/home', 'DashboardController@index')->name('home');
// Route::get('dropdownlist','DataController@getCountries');
// Route::get('dropdownlist/getstates/{id}','DataController@getStates');
});



//Auth::routes();

/* overridden to give custom names to routes */
Route::get('login','Auth\LoginController@showLoginForm')->name('customer.login.show');
Route::post('login', 'Auth\LoginController@login')->name('customer.login');
Route::post('logout', 'Auth\LoginController@logout')->name('customer.logout');
//Route::get('register','Auth\RegisterController@showRegistrationForm')->name('customer.register');
//Route::post('register','Auth\RegisterController@register')->name('customer.login.show.register');
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
Route::get('email/verify', 'Auth\VerificationController@show')->name('customer.verification.notice');
Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('customer.verification.verify');
Route::post('email/resend', 'Auth\VerificationController@resend')->name('customer.verification.resend');

Route::get('passchanged', function () { return view('/pwdchange');})->name('passchanged');

Route::get('emailvarify', function () { return view('/emailverify');})->name('emailvarify');

//Route::get('blankpg', function () { return view('admin/blank/index');});
//Route::get('blankform', function () { return view('admin/blank/form');});



