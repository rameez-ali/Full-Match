<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Page\GetPageRequest;
use App\Model\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public $successStatus = 200;
    public $HTTP_FORBIDDEN = 403;
    public $HTTP_NOT_FOUND = 404;

    public function cmsPage($id)
    {
        $array = array();

        $request = new GetPageRequest();

        $request->id = $id;

        $cmspage = $request->handleApi();

        if (isset($cmspage)) {

                $array['id'] = $cmspage->id;
                $array['name'] = $cmspage->name;
                $array['content'] = $cmspage->content;

            return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'page found.', 'data' => $array]);

        }

        else {

            return response()->json(['success' => false, 'status' => $this->HTTP_NOT_FOUND, 'message' => 'page Not Found.', 'data' => []]);
        }
    }
}
