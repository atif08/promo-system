<?php

namespace App\Models\UserAttributes;

use App\Enums\UserTypeEnum;
use App\Models\Marketplace;
use App\Models\User;

trait HasTypeAttributes {

    public function isAdmin(): bool {
        return $this->user_type == UserTypeEnum::ADMIN();
    }

//    public function isCompany(): bool {
//        return $this->user_type == self::USER_TYPE_COMPANY;
//    }
//
//    public function isTeam(): bool {
//        return $this->user_type == self::USER_TYPE_TEAM;
//    }
//
//    public function isClient(): bool {
//        return $this->user_type == self::USER_TYPE_CLIENT;
//    }
    /**
     * @return boolean
     */
    public function isSeller(): bool {
        return $this->user_type == UserTypeEnum::SELLER();
    }

    /**
     * @param Marketplace $marketplace
     * @param string|null $profile_id
     * @param string|null $name
     * @return User
     */
    public function registerSeller(Marketplace $marketplace, string $profile_id = null, string $name = null): User
    {
        /** @var User $account */
        $account = self::query()->firstOrCreate([
            'user_type'      => UserTypeEnum::SELLER(),
            'parent_id'      => $this->id,
            'marketplace_id' => $marketplace->id,
            'region_code'    => $marketplace->region_code
        ]);

        if ($profile_id) {
            $account->profile_id = $profile_id;
        }

        if ($name) {
            $account->name = $name;
        }

        $account->save();

        return $account;
    }

    public static function getActiveCallables($user_type = [self::USER_TYPE_SELLER]) {
        $user_types = is_array($user_type) ? $user_type : explode(',', $user_type);
        return self::query()
            ->whereIn('user_type', $user_types)
            ->where('is_active', true)
            ->where(function ($query) {
                $query->whereNull('parent_id')
                    ->orWhereHas('parent', function ($query) {
                        $query->where('is_active', true);
                    });
            })
            ->get();
    }

    public function getActiveMarketplaces($user_type = self::USER_TYPE_SELLER) {
        return match (true) {
            $this->isCompany() => self::query()
                ->where('user_type', $user_type)
                ->where('is_active', true)
                ->where('parent_id', $this->id)
                ->get(),

            default => $this->user_accounts()
                ->where('is_active', true)
                ->get()
        };
    }

    public function getActiveIds(): array {
        return $this->getActiveMarketplaces()->pluck('id')->toArray();
    }
}
