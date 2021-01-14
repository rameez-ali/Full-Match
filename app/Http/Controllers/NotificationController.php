<?php

namespace App\Http\Controllers;

use App\Http\Requests\Notification\CreateNotificationRequest;
use App\Http\Requests\Notification\GetAllNotificationsRequest;
use App\Http\Requests\Notification\GetNotificationRequest;
use App\Http\Requests\Subsplans\GetAllSubsPlanRequest;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GetAllNotificationsRequest $request)
    {
        $response = $request->handle();

        return view('admin.notification.index',['notifications' => $response] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(GetNotificationRequest $request)
    {
        $request->id = 0;

        $response = $request->handle();

        $route = url('notification');

        return view('admin.notification.form',['notification' => $response, 'route' => $route, 'edit' => false ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateNotificationRequest $request)
    {
        $response = $request->handle();

        return redirect()->route('notification.index')->with('notifiyaddsuccess','Notification add Successfully');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
