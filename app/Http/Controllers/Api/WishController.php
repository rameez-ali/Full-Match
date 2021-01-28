<?php

namespace App\Http\Controllers\Api;

use App\customer;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\Video;
use App\Model\League;
use App\Model\Video_genre;
use App\Model\Videogenre;
use App\Model\Club;
use App\Model\Player;
use App\Model\Videoclub;
use App\Model\Videoplayer;
use App\Model\Season;
use App\Model\Notify_user;
use App\Model\Popular_search;
use DB;
use \stdClass;

use Illuminate\Support\Facades\Auth;
use App\User;


class WishController extends Controller
{
  public $successStatus = 200;
  public $HTTP_FORBIDDEN = 403;
  public $HTTP_NOT_FOUND = 404;

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function wishlist(Request $request)
    {
//        dd(Auth::user()->id);

    }








}
