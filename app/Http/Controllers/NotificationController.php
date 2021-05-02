<?php

namespace App\Http\Controllers;

use App\Http\Requests\Notification\CreateNotificationRequest;
use App\Http\Requests\Notification\GetAllNotificationsRequest;
use App\Http\Requests\Notification\GetNotificationRequest;
use App\Http\Requests\Notification\SendNotificationRequest;
use App\Http\Requests\Notification\UpdateNotificationRequest;
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
        $request = new GetNotificationRequest();

        $request->id = $id;

        $response = $request->handle();

        return view('admin.notification.show',['notification' => $response ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $request = new GetNotificationRequest();

        $request->id = $id;

        $response = $request->handle();

        $route = route('notification.update', ['notification' => $response->id]);

        return view('admin.notification.form',['notification' => $response, 'route' => $route , 'edit' => true ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNotificationRequest $request, $id)
    {
        $request->id = $id;

        $response = $request->handle();

        return redirect()->route('notification.index')->with('notifiyeditsuccess','Notification Edit Successfully');
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
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sendNotification($id)
    {
        
        $request = new SendNotificationRequest();

        $request->id = $id;

        $response = $request->handle();

        return redirect()->route('notification.index')->with('notifiysendsuccess','Notification Sent Successfully');

    }
}
