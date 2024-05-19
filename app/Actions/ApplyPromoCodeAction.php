<?php

namespace App\Actions;

use App\Models\PromoCode;
use Illuminate\Support\Facades\Auth;

class ApplyPromoCodeAction
{
    public function handle(PromoCode $promoCode, float $orderTotal)
    {
        $discountAmount = 0;

        if ($promoCode->type === PromoCode::Percent) {
            $discountAmount = ($promoCode->amount / 100) * $orderTotal;
        } elseif ($promoCode->type === PromoCode::Flat) {
            $discountAmount = min($promoCode->amount, $orderTotal);
        }

        // Check if the promo code is applied on the user's birthday
        if (Auth::user()->dob->isToday()) {
            $additionalDiscount = 0.1 * $discountAmount; // 10% additional discount
            $discountAmount += $additionalDiscount;
        }

        return $discountAmount;
    }

}
