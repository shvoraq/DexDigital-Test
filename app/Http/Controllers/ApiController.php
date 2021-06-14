<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApiRequest;
use App\Models\Order;

class ApiController extends Controller
{
    public function callback(ApiRequest $request){

        $validated = $request->validated();
        $order = $validated['order'];
        $transactions = $validated['transactions'];

        Order::create($order)->transaction()->createMany($transactions);

        if ($request->has('error')){
            return response()->json([
                'status' => $order['status'],
                'message' => $request->error['recommended_message_for_user']
            ]);
        }else{
            return response()->json([
                'status' => $order['status']
            ]);
        }
    }
}
