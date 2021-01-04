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

Route::group(['middleware' => ['auth']], function () {
    Route::get('dashboard', 'DashboardController@dash')->name('dashboard');
    Route::resource('customer', 'CustomerController');
    Route::resource('subscriptionplans','SubsPlanController');
    Route::resource('category-form','ProjectCategoryViewController');
    Route::resource('player-form','ProjectPlayerViewController');
    Route::resource('club-form','ProjectClubViewController');
    Route::resource('league-form','ProjectLeagueViewController');
    Route::get('league/{id}','ProjectLeagueViewController@destroy1');
    Route::resource('video-form','ProjectVideoViewController');
    Route::get('getstates/{id}','ProjectVideoViewController@getStates');
    Route::resource('subscriptionplans','SubsPlanController');
    Route::resource('page', 'PageController')->only(['index','edit','update']);
    Route::get('videoclub/{id}','ProjectVideoViewController@destroy1');
    Route::get('videodetails/{id}','ProjectVideoViewController@video_details');
    
    Route::resource('slider-form','ProjectSliderViewController');
    Route::get('slider-form/create/getstates/{id}','ProjectSliderViewController@getStates');
    Route::get('slider/{id}','ProjectSliderViewController@destroy1');
    
    Route::resource('my-form','SeasonPartSortingController');
    Route::get("addmore","SeasonPartSortingController@addMore");
    Route::post("addmore","SeasonPartSortingController@addMorePost");


    Route::post("addmore","SeasonPartSortingController@addMorePost");
    Route::get("order","OrderController@index")->name('order.all');
    Route::get("order/{id}","OrderController@show")->name('order.show');


// Route::get('dropdownlist','DataController@getCountries');
// Route::get('dropdownlist/getstates/{id}','DataController@getStates');
});
Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();

/* overridden to give custom names to routes */
    Route::get('login','Auth\LoginController@showLoginForm')->name('customer.login.show');
    Route::post('login', 'Auth\LoginController@login')->name('customer.login');
    Route::post('logout', 'Auth\LoginController@logout')->name('customer.logout');
    Route::get('register','Auth\RegisterController@showRegistrationForm')->name('customer.register');
    Route::post('register','Auth\RegisterController@register')->name('customer.login.show.register');
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('customer.password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('customer.password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('customer.password.update');
    Route::get('email/verify', 'Auth\VerificationController@show')->name('customer.verification.notice');
    Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('customer.verification.verify');
    Route::post('email/resend', 'Auth\VerificationController@resend')->name('customer.verification.resend');


Route::get('blankpg', function () { return view('admin/blank/index');});
Route::get('blankform', function () { return view('admin/blank/form');});

Route::get('userr', function () { return view('admin/customer/index');});


