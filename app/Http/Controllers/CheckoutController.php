<?php

namespace App\Http\Controllers;

use App\Actions\ApplyPromoCodeAction;
use App\Actions\SaveOrderAction;
use App\Http\Requests\CheckOutRequest;
use App\Services\FlashMessage;
use Illuminate\Http\RedirectResponse;

class CheckoutController extends Controller
{
    public function __construct(protected readonly SaveOrderAction         $saveOrderAction,
                                protected readonly ApplyPromoCodeAction $applyPromoCodeAction
    )
    {

    }

    public function process(CheckOutRequest $request): RedirectResponse
    {
        $orderTotal = 200.00;

        try {

           list($promoId,$discountAmount,$orderTotal) =  $this->applyPromoCodeAction->handle($orderTotal,$request->promo_code);

            $this->saveOrderAction->handle(
                request: $request,
                discount: $discountAmount,
                orderTotal: $orderTotal,
                promoId: $promoId
            );

        }catch (\Exception $e){

            FlashMessage::error($e->getMessage());
            return redirect()->back()->withInput();

        }

        FlashMessage::success('Order placed successfully');

        return redirect()->back();
    }
}
