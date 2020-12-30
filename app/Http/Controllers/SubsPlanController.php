<?php

namespace App\Http\Controllers;

use App\Http\Requests\Subsplans\CreateSubsPlanRequest;
use App\Http\Requests\Subsplans\DeleteSubsPlanRequest;
use App\Http\Requests\Subsplans\GetAllSubsPlanRequest;
use App\Http\Requests\Subsplans\GetSubsPlanRequest;
use App\Http\Requests\Subsplans\UpdateSubsPlanRequest;
use Illuminate\Http\Request;

class SubsPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GetAllSubsPlanRequest $request)
    {
        $response = $request->handle();

        return view('admin.subscriptionplan.index',['subscriptionplans' => $response] );
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
