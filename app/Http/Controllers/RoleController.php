<?php

namespace App\Http\Controllers;

use App\Http\Requests\Role\CreateRoleRequest;
use App\Http\Requests\Role\DeleteRoleRequest;
use App\Http\Requests\Role\GetAllRolesRequest;
use App\Http\Requests\Role\GetRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GetAllRolesRequest $request)
    {
        $response = $request->handle();

        return view('admin.role.index',['roles' => $response]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(GetRoleRequest $request)
    {
        $request->id = 0;

        $response = $request->handle();

        $route = url('role');

        return view('admin.role.form',['role' => $response, 'route' => $route, 'edit' => false ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRoleRequest $request)
    {
        $response = $request->handle();

        return redirect()->route('role.index')->with('roleaddsuccess','Role add Successfully');
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
        $request = new GetRoleRequest();

        $request->id = $id;

        $response = $request->handle();

        $route = route('role.update', ['role' => $response->id]);

        return view('admin.role.form',['role' => $response, 'route' => $route , 'edit' => true ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequest $request, $id)
    {
        $request->id = $id;

        $response = $request->handle();

        return redirect()->route('role.index')->with('roleeditsuccess','Role Edit Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $request = new DeleteRoleRequest();

        $request->id = $id;

        $response = $request->handle();

        return redirect()->route('role.index')->with('roledeletesuccess','Role Delete Successfully');
    }
}
