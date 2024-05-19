<?php

namespace App\Enums;


use Spatie\Enum\Laravel\Enum;

/**
 * @method static self ADMIN()
 * @method static self BUYER()
 * @method static self WAREHOUSE()
 * @method static self DEVELOPER()
 * @method static self SELLER()
 */
final class UserTypeEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'SELLER' => 'seller',
            'ADMIN' => 'admin',
            'BUYER' => 'buyer',
            'WAREHOUSE' => 'warehouse',
            'DEVELOPER' => 'developer',
        ];
    }
    public static function forDropDown()
    {
        $array = [];
        collect(self::cases())->each(function ($case) use (&$array) {
            $array[$case->value] = $case->label;
        });
        return $array;

    }
}
