<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\ProjectCategory;
use App\Model\Player;
use App\Model\Videoplayer;


class PlayerController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

public $successStatus = 200;
public $HTTP_FORBIDDEN = 403;
public $HTTP_NOT_FOUND = 404;
    public function players()
    {
     $players = Player::all();
     return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Player found.', 'data' => $players]);


    }


    public function player($id)
    {
        if (Videoplayer::where('Player_id', $id)->exists()) {

            $video_player=Videoplayer::select('videos.id','videos.video_title','videos.video_img')
            ->join('videos','videoplayers.Video_id' , '=' ,'videos.id')
            ->where('Player_id','=', $id)
            ->get();
         return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Player found.', 'data' => $video_player]);
        }

        else {
           return response()->json(['error' => false, 'status' => $this->HTTP_NOT_FOUND, 'message' => 'No player found.']);
         }


    }

}
