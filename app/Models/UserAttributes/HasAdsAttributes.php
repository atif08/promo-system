<?php

namespace App\Models\UserAttributes;

use App\Models\AdsModels\AdsPlan;

trait HasAdsAttributes {

    public function recentAdsPlan() {
        return $this->ads_plans()
            ->whereIn('status', [AdsPlan::STATUS_WORKING, AdsPlan::STATUS_PENDING])
            ->orderBy('id', 'DESC')
            ->first();
    }

    public function lastAdsPlan() {
        return $this->ads_plans()
            ->whereIn('status', [AdsPlan::STATUS_DONE])
            ->orderBy('id', 'DESC')
            ->first();
    }

    public static function getAdsCallables($user_type = [self::USER_TYPE_SELLER]) {
        $user_types = is_array($user_type) ? $user_type : explode(',', $user_type);
        return self::query()
            ->whereIn('user_type', $user_types)
            ->where('is_active', true)
            ->whereHas('parent', function ($query) {
                $query->where('is_active', true);
            })
            ->whereHas('ads_token')
            ->get();
    }
}
