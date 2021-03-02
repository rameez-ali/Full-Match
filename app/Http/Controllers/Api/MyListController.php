<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MyList\CreateMyListRequest;
use App\Http\Requests\MyList\DeleteMyListRequest;
use App\Http\Requests\MyList\GetAllMyListRequest;
use http\Env\Request;


class MyListController extends Controller
{
    public $successStatus = 200;
    public $HTTP_FORBIDDEN = 403;
    public $HTTP_NOT_FOUND = 404;

    public function addToMylist(CreateMyListRequest $request, $id)
    {
        $request->id = $id;

        $request->custinfo = $request->user()->id;

        $request->handle();

        return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Add To My List.']);
    }

    public function removeToMylist(DeleteMyListRequest $request, $id)
    {
        $request->id = $id;

        $request->custinfo = $request->user()->id;

        $request->handle();

        return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Remove To My List.']);
    }

    public function getAllMylist(GetAllMyListRequest $request)
    {
        $request->custinfo = $request->user()->id;

        $allmywishlist = $request->handle();


        $array = array();
        if (!$allmywishlist->isEmpty()) {
            foreach ($allmywishlist as $k => $v) {

                $image = str_replace('\\', '/', asset('app-assets/images/video/' . $v->wishlistvideo->video_img));

                $array[$k]['id'] = $v->id;
                $array[$k]['video_id'] = $v->video_id;
                $array[$k]['name'] = $v->wishlistvideo->title_en;
                $array[$k]['name_ar'] = $v->wishlistvideo->title_ar;
                $array[$k]['link'] = $v->wishlistvideo->video_link;
                $array[$k]['route'] = "video/".$v->video_id;
                $array[$k]['image'] = $image;
            }
            return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'My Lists Found.', 'data' => $array]);
        }
        else {
            return response()->json(['success' => false, 'status' => $this->HTTP_NOT_FOUND, 'message' => 'No My Lists Found.', 'data' => []]);
        }

    }
}
