<?php

use App\AmazonReports\MerchantListingsReport;
use App\AmazonReports\SalesAndTraffic;
use App\Enums\UserTypeEnum;
use App\Models\AmazonReports\AmazonReport;
use App\Models\User;

return [
    AmazonReport::SALES_AND_TRAFFIC_REPORT => [
        'report_type'    => 'GET_SALES_AND_TRAFFIC_REPORT',
        'class'          => SalesAndTraffic::class,
        'type'           => UserTypeEnum::SELLER(),
        'real_time'      => false,
        'lookback_days'  => 180,
        'days_span'      => 0,
        'process_delay'  => 3600,
        'report_options' => [
            'dateGranularity' => 'DAY', // DAY, WEEK, MONTH
            'asinGranularity' => 'SKU', // PARENT, CHILD, SKU
            'sellingProgram'  => 'RETAIL', // RETAIL, BUSINESS, FRESH
        ]
    ],
    AmazonReport::GET_MERCHANT_LISTINGS_DATA => [
        'report_type'    => 'GET_MERCHANT_LISTINGS_DATA',
        'class'          => MerchantListingsReport::class,
        'type'           => UserTypeEnum::SELLER(),
        'real_time'      => false,
        'lookback_days'  => 180,
        'days_span'      => 0,
        'process_delay'  => 3600,
        'report_options' => [
            'dateGranularity' => 'DAY', // DAY, WEEK, MONTH
            'asinGranularity' => 'SKU', // PARENT, CHILD, SKU
            'sellingProgram'  => 'RETAIL', // RETAIL, BUSINESS, FRESH
        ]
    ],
];
