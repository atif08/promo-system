<?php

namespace App\Models\UserAttributes;

use AmazonSellingPartner\Exception\ApiException;
use AmazonSellingPartner\Exception\InvalidArgumentException;
use App\AmazonSpClients\SellersApiClient;
use Exception;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;

trait HasSpAttributes {

    public function hasSellingPartnerAccess(): bool {
        try {
            (new SellersApiClient($this))->listParticipations();
            return true;
        } catch (ApiException|InvalidArgumentException|JsonException|ClientExceptionInterface|Exception $e) {
            console_log($e->getMessage());
            return false;
        }
    }

    public static function getSpCallables($user_type = ['seller']) {
        $user_types = is_array($user_type) ? $user_type : explode(',', $user_type);
        return self::query()
            ->whereIn('user_type', $user_types)
            ->where('is_active', true)
            ->whereHas('parent', function ($query) {
                $query->where('is_active', true);
            })
            ->whereHas('sp_token')
            ->get();
    }
}
