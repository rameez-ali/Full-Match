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
use App\Model\DeviceToken;
use App\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public $successStatus = 200;
    public $HTTP_FORBIDDEN = 403;
    public $HTTP_NOT_FOUND = 404;
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

//        return view('admin.customer.form',['customer' => $response, 'route' => $route, 'edit' => false ]);
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

//        return redirect()->route('customer.index')->with('useraddsuccess','User add Successfully');
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
    public function edit(Request $customer)
    {
        $array = array();

        $request = new GetCustomerRequest();

        $request->id = $customer->user()->id;

        $response = $request->handle_editApi();

        $route = route('customer.profupdate', $response->id);

        if (isset($response)) {

            $array['id'] = $response->user_id;
            $array['logo'] = url($response->user_image);
            $array['name'] = $response->name;
            $array['email'] = $response->email;
            $array['phone'] = $response->user->phone;
            $array['updatelink'] = $route;

            return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'customer found.', 'data' => $array]);

        } else {

            return response()->json(['success' => false, 'status' => $this->HTTP_NOT_FOUND, 'message' => 'customer Not Found.', 'data' => []]);
        }

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

        $response = $request->handleProfileUpdate();

        if ($response) {

            return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Profile Updated.']);

        } else {

            return response()->json(['success' => false, 'status' => $this->HTTP_NOT_FOUND, 'message' => 'Profile Not Updated.']);
        }

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
    use SendsPasswordResetEmails;
    public function forgotpass(Request $request)
    {
        $customer = customer::where('email',$request->email)->get();

        if (!$customer->isEmpty()) {
            $this->sendResetLinkEmail($request);

            return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Email Found and sent.']);

        }else{

            return response()->json(['success' => false, 'status' => $this->HTTP_NOT_FOUND, 'message' => 'Email Not Found.']);
        }

    }

    public function initalToken(Request $request)
    {
        $selected_token = DeviceToken::where('token' ,$request->token)->first();

        if ($selected_token == null){
            $device_token = new DeviceToken([
                'device' => $request->deviceType,
                'token' => $request->token,
            ]);
            $device_token->save();

            return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Device add Successfully']);
        }else{

            return response()->json(['success' => false, 'status' => $this->HTTP_NOT_FOUND, 'message' => 'Device already added']);
        }
    }
}
