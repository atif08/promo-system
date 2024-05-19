<?php

namespace App\Http\Controllers;

use App\Actions\ApplyPromoCodeAction;
use App\Actions\SaveOrderAction;
use App\Actions\ValidatePromoCodeAction;
use App\Http\Requests\CheckOutRequest;
use App\Models\PromoCode;
use App\Services\FlashMessage;
use Illuminate\Http\RedirectResponse;

class CheckoutController extends Controller
{
    public function __construct(protected readonly SaveOrderAction         $saveOrderAction,
                                protected readonly ValidatePromoCodeAction $validatePromoCodeAction,
                                protected readonly ApplyPromoCodeAction    $applyPromoCodeAction
    )
    {

    }

    public function process(CheckOutRequest $request): RedirectResponse
    {
        $orderTotal = 200;
        $discountAmount = 0;
        $promoId = null;

        if ($request->promo_code) {
            $promoCode = PromoCode::where('promo_code', $request->promo_code)
                ->where('start_date', '<=', now())
                ->where('end_date', '>=', now())
                ->first();

            if (!$this->validatePromoCodeAction->handle($promoCode)) {
                return redirect()->back()->withInput();
            }

            $discountAmount = $this->applyPromoCodeAction->handle($promoCode, $orderTotal);

            // Update the usage limits for the promo code
            $promoCode->decrement('usage_limit');
            $promoId =$promoCode->id;
        }


        $this->saveOrderAction->handle(
            request: $request,
            discount: $discountAmount,
            orderTotal: $orderTotal,
            promoId: $promoId
        );

        FlashMessage::success('Order place successfully');

        return redirect()->back();
    }
}
