<?php

declare(strict_types=1);

namespace AmazonSellingPartner\Model\Orders;

/**
 * Selling Partner API for Orders.
 *
 * The Selling Partner API for Orders helps you programmatically retrieve order information. These APIs let you develop fast, flexible, custom applications in areas like order synchronization, order research, and demand-based decision support tools.
 *
 * The version of the OpenAPI document: v0
 *
 * This class was auto-generated by https://openapi-generator.tech
 * Do not change it, it will be overwritten with next execution of /bin/generate.sh
 */
class ItemApprovalStatus
{
    /**
     * Possible values of this enum.
     */
    final public const PENDING_SELLING_PARTNER_APPROVAL = 'PENDING_SELLING_PARTNER_APPROVAL';

    final public const PROCESSING_SELLING_PARTNER_APPROVAL = 'PROCESSING_SELLING_PARTNER_APPROVAL';

    final public const PENDING_AMAZON_APPROVAL = 'PENDING_AMAZON_APPROVAL';

    final public const APPROVED = 'APPROVED';

    final public const APPROVED_WITH_CHANGES = 'APPROVED_WITH_CHANGES';

    final public const DECLINED = 'DECLINED';

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
            self::PENDING_SELLING_PARTNER_APPROVAL,
            self::PROCESSING_SELLING_PARTNER_APPROVAL,
            self::PENDING_AMAZON_APPROVAL,
            self::APPROVED,
            self::APPROVED_WITH_CHANGES,
            self::DECLINED,
        ];
    }

    public function toString() : string
    {
        return $this->value;
    }
}
