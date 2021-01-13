<?php

namespace App\Http\Controllers;

use App\Http\Requests\Discount\ValidatePromoRequest;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function verify(ValidatePromoRequest $request)
    {
        $response = $request->handle();

        return response()->json($response);
    }
}
