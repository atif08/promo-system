<?php

namespace App\Http\Controllers;

use App\Actions\ApplyPromoCodeAction;
use App\Actions\SaveOrderAction;
use App\Actions\ValidatePromoCodeAction;
use App\Http\Requests\CheckOutRequest;
use App\Models\Order;
use App\Models\PromoCode;
use App\Services\FlashMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserPromoCodesController extends Controller
{


    public function __invoke():View
    {
        $orders = Order::with(['user','promo'])->whereNotNull('promo_code_id')->get();
        return view('user_promo.index',compact('orders'));

    }
}
