<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MyList\CreateMyListRequest;


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

        return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Notification OFF.']);
    }
}
