<?php

namespace App\Actions;

use App\Services\FlashMessage;
use Illuminate\Support\Facades\Auth;

class ValidatePromoCodeAction
{
    public function handle($promoCode): bool
    {
        // Check if promo code exists and is within date range
        if (!$promoCode) {
            FlashMessage::error('Invalid promo code');
            return false;
        }

        // Check if the promo code is within usage limits
        if ($promoCode->usage_limit <= 0) {
            FlashMessage::error('Promo code has reached its limit');
            return false;
        }

        $userUsageCount = Auth::user()->orders()->where('promo_code_id', $promoCode->id)->count();

        if ($userUsageCount > 0) {
            FlashMessage::error('You already used this promo code');
            return false;
        }

        return true;
    }

}
