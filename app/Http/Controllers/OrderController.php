<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\GetAllOrderRequest;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(GetAllOrderRequest $request)
    {
        $response = $request->handle();

        return view('admin.order.index',['orders' => $response] );
    }
}
