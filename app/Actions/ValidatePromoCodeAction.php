<?php

namespace App\Actions;

use AmazonSellingPartner\Exception\Exception;
use App\Services\FlashMessage;
use Illuminate\Support\Facades\Auth;

class ValidatePromoCodeAction
{
    public function handle($promoCode): void
    {
        // Check if promo code exists and is within date range
        if (!$promoCode) {

            throw new Exception('Invalid promo code');
        }

        // Check if the promo code is within usage limits
        if ($promoCode->hasLimit()) {

            throw new Exception('Promo code has reached its limit');

        }

        if (request()->user()->isUserCanUsePromo($promoCode)) {

            throw new Exception('You already used this promo code');
        }
    }

}
