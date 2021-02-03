<?php

namespace App\Http\Controllers;

use App\Http\Requests\Role\GetAllRolesRequest;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\DeleteUserRequest;
use App\Http\Requests\User\GetAllUsersRequest;
use App\Http\Requests\User\GetUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GetAllUsersRequest $request)
    {
        $response = $request->handle();

        return view('admin.user.index',['users' => $response] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(GetUserRequest $request)
    {
        $request->id = 0;

        $response = $request->handle();

        $route = url('user');

        $request = new GetAllRolesRequest();

        $roles = $request->handle();

        return view('admin.user.form',['user' => $response, 'route' => $route, 'roles' => $roles, 'edit' => false ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $response = $request->handle();

        return redirect()->route('user.index')->with('useraddsuccess','System User add Successfully');
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
        $request = new GetUserRequest();

        $request->id = $id;

        $response = $request->handle();

        $request = new GetAllRolesRequest();

        $roles = $request->handle();

        $route = route('user.update', ['user' => $response->id]);

        return view('admin.user.form',['user' => $response, 'route' => $route , 'roles' => $roles , 'edit' => true ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $request->id = $id;

        $response = $request->handle();

        return redirect()->route('user.index')->with('usereditsuccess','System User Edit Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $request = new DeleteUserRequest();

        $request->id = $id;

        $response = $request->handle();

        return redirect()->route('user.index')->with('userdeletesuccess',' System User Delete Successfully');
    }
}
