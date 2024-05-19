<?php

namespace App\Actions;

use App\Http\Requests\CheckOutRequest;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class SaveOrderAction
{
    public function handle(CheckOutRequest $request,$discount,$orderTotal,$promoId=null): Order
    {
        $orderTotal -= $discount;

        $order = new Order();
        $order->user_id = Auth::id();
        $order->first_name = $request->first_name;
        $order->last_name = $request->last_name;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->address = $request->address;
        $order->city = $request->city;
        $order->state = $request->state;
        $order->zip = $request->zip;
        $order->country = 'dubai';
        $order->payment_method = $request->payment_method;
        $order->promo_code_id = $promoId;
        $order->discount = $discount;
        $order->total = $orderTotal;

        $order->save();

        $order->fresh();

        return $order;

    }

}
