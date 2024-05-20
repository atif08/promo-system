<?php

namespace App\Actions;

use App\Models\PromoCode;

class ApplyPromoCodeAction
{

    public function __construct(private readonly ValidatePromoCodeAction $validatePromoCodeAction,
                                private readonly CalculateDiscountAction $calculateDiscountAction)
    {
    }

    public function handle(float $orderTotal,string $promoCodeString =null): array
    {
        if (!$promoCodeString) {
            return [null,0,$orderTotal];
        }

        $promoCode = PromoCode::where('promo_code', $promoCodeString)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->first();

        /**
         * @throws \Exception
         */

        $this->validatePromoCodeAction->handle($promoCode);

        $discountAmount = $this->calculateDiscountAction->handle($promoCode, $orderTotal);
        $orderTotal-=$discountAmount;

        // Update the usage limits for the promo code
        $promoCode->decrement('usage_limit');

        return [$promoCode->id,$discountAmount,$orderTotal];
    }

}
