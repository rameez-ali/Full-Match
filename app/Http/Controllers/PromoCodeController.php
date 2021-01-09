<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customer\GetAllCustomerRequest;
use App\Http\Requests\Discount\CreateDiscountRequest;
use App\Http\Requests\Discount\DeleteDiscountRequest;
use App\Http\Requests\Discount\GetAllDiscountRequest;
use App\Http\Requests\Discount\GetDiscountRequest;
use App\Http\Requests\Discount\UpdateDiscountRequest;
use Illuminate\Http\Request;

class PromoCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GetAllDiscountRequest $request)
    {
        $response = $request->handle();

        return view('admin.discount.index',['discounts' => $response] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(GetDiscountRequest $request)
    {
        $request->id = 0;

        $response = $request->handle();

        $route = url('discount');

        $request = new GetAllCustomerRequest();

        $customers = $request->handle();

        return view('admin.discount.form',['discount' => $response, 'route' => $route, 'customers' => $customers, 'edit' => false ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDiscountRequest $request)
    {
        $response = $request->handle();

        return redirect()->route('discount.index')->with('discountaddsuccess','Discount add Successfully');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $request = new GetDiscountRequest();

        $request->id = $id;

        $response = $request->handle();

        $route = route('discount.update', ['discount' => $response->id]);

        $request = new GetAllCustomerRequest();

        $customers = $request->handle();

        return view('admin.discount.form',['discount' => $response, 'route' => $route , 'customers' => $customers, 'edit' => true ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDiscountRequest $request, $id)
    {
        $request->id = $id;

        $response = $request->handle();

        return redirect()->route('discount.index')->with('discounteditsuccess','Discount Edit Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $request = new DeleteDiscountRequest();

        $request->id = $id;

        $response = $request->handle();

        return redirect()->route('discount.index')->with('discountdeletesuccess','Discount Delete Successfully');
    }
}
