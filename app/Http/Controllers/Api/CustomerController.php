<?php

namespace App\Http\Controllers\Api;

use App\customer;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\CreateCustomerRequest;
use App\Http\Requests\Customer\DeleteCustomerRequest;
use App\Http\Requests\Customer\GetAllCustomerRequest;
use App\Http\Requests\Customer\GetCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;
use App\Http\Resources\CustomerResource;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GetAllCustomerRequest $request)
    {
        $response = $request->handle();

        return CustomerResource::collection($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(GetCustomerRequest $request)
    {
        $request->id = 0;

        $response = $request->handle();

        $route = url('customer');

        return view('admin.customer.form',['customer' => $response, 'route' => $route, 'edit' => false ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCustomerRequest $request)
    {
        $response = $request->handle();

        return redirect()->route('customer.index')->with('useraddsuccess','User add Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $request = new GetCustomerRequest();

        $request->id = $id;

        $response = $request->handle_edit();

        $route = route('customer.update', ['customer' => $response->id]);

        return view('admin.customer.form',['customer' => $response, 'route' => $route , 'edit' => true ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerRequest $request, $id)
    {
        $request->id = $id;

        $response = $request->handle();

        return redirect()->route('customer.index')->with('usereditsuccess','User Edit Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $request = new DeleteCustomerRequest();

        $request->id = $id;

        $response = $request->handle();

        return redirect()->route('customer.index')->with('userdeletesuccess','User Delete Successfully');
    }
}
