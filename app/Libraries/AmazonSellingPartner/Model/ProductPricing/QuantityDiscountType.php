<?php

declare(strict_types=1);

namespace AmazonSellingPartner\Model\ProductPricing;

/**
 * Selling Partner API for Pricing.
 *
 * The Selling Partner API for Pricing helps you programmatically retrieve product pricing and offer information for Amazon Marketplace products.
 *
 * The version of the OpenAPI document: v0
 *
 * This class was auto-generated by https://openapi-generator.tech
 * Do not change it, it will be overwritten with next execution of /bin/generate.sh
 */
class QuantityDiscountType
{
    /**
     * Possible values of this enum.
     */
    final public const QUANTITY_DISCOUNT = 'QUANTITY_DISCOUNT';

    public function __construct(private readonly string $value)
    {
    }

    /**
     * Gets allowable values of the enum.
     *
     * @return string[]
     */
    public static function getAllowableEnumValues() : array
    {
        return [
            self::QUANTITY_DISCOUNT,
        ];
    }

    public function toString() : string
    {
        return $this->value;
    }
}