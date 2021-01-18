<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiOrderController extends Controller
{
    public function getCurrency()
    {
        return 'KWD';
    }
}
