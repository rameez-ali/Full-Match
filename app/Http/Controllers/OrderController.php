<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customer\GetAllCustomerRequest;
use App\Http\Requests\Order\CreateOrderRequest;
use App\Http\Requests\Order\GetAllOrderRequest;
use App\Http\Requests\Order\GetOrderRequest;
use App\Http\Requests\Subsplans\GetAllSubsPlanRequest;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(GetAllOrderRequest $request)
    {
        $response = $request->handle();

        return view('admin.order.index',['orders' => $response] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(GetOrderRequest $request)
    {
        $request->id = 0;

        $response = $request->handle();

        $route = url('order');

        $request = new GetAllCustomerRequest();

        $allcusts = $request->handle();

        $request = new GetAllSubsPlanRequest();

        $allsubplans = $request->handle();

        return view('admin.order.form',
            [   'order' => $response,
                'allcusts' => $allcusts,
                'allsubplans' => $allsubplans,
                'route' => $route,
                'edit' => false ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateOrderRequest $request)
    {
        $response = $request->handle();

        return redirect()->route('subscriptionplans.index')->with('planaddsuccess','Plan add Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
}
