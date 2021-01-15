<?php

namespace App\Http\Controllers;

use App\Http\Requests\Dashboard\GetDashboardRequest;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(GetDashboardRequest $request)
    {
        $response = $request->handle();
        return view('admin.dashboard.index',['data' => $response]);
    }
}
