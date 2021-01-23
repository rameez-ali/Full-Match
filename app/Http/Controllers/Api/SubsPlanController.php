<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Subsplans\CreateSubsPlanRequest;
use App\Http\Requests\Subsplans\DeleteSubsPlanRequest;
use App\Http\Requests\Subsplans\GetAllSubsPlanRequest;
use App\Http\Requests\Subsplans\GetSubsPlanRequest;
use App\Http\Requests\Subsplans\UpdateSubsPlanRequest;
use App\Http\Resources\CustomerResource;
use Illuminate\Http\Request;

class SubsPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $successStatus = 200;
    public $HTTP_FORBIDDEN = 403;
    public $HTTP_NOT_FOUND = 404;
    public function index(GetAllSubsPlanRequest $request)
    {
        $array = array();

        $plans = $request->handleApi();

        if (!$plans->isEmpty()) {

            foreach ($plans as $k => $v) {

                $array[$k]['id'] = $v->id;
                $array[$k]['title'] = $v->plan_title;
                $array[$k]['title_ar'] = $v->plan_title_ar;
                $array[$k]['description'] = $v->plan_Description;
                $array[$k]['description_ar'] = $v->plan_Description_ar;
                $array[$k]['price'] = $v->plan_price;
                $array[$k]['duration_type'] = $v->duration_type;
                $array[$k]['duration_value'] = $v->duration_value;
                $array[$k]['sort_by'] = $v->sort_by;
                $array[$k]['notify'] = $v->notify;
            }
            return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Plans found.', 'data' => $array]);
        }else{
            return response()->json(['error' => false, 'status' => $this->HTTP_NOT_FOUND, 'message' => 'No record found.', 'data' => []]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(GetSubsPlanRequest $request)
    {
        $request->id = 0;

        $response = $request->handle();

        $route = url('subscriptionplans');

        return view('admin.subscriptionplan.form',['subscriptionplan' => $response, 'route' => $route, 'edit' => false ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSubsPlanRequest $request)
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $request = new GetSubsPlanRequest();

        $request->id = $id;

        $response = $request->handle();

        $route = route('subscriptionplans.update', ['subscriptionplan' => $response->id]);

        return view('admin.subscriptionplan.form',['subscriptionplan' => $response, 'route' => $route , 'edit' => true ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubsPlanRequest $request, $id)
    {
        $request->id = $id;

        $response = $request->handle();

        return redirect()->route('subscriptionplans.index')->with('planeditsuccess','Plan Edit Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $request = new DeleteSubsPlanRequest();

        $request->id = $id;

        $response = $request->handle();

        return redirect()->route('subscriptionplans.index')->with('plandeletesuccess','Plan Delete Successfully');
    }
}
