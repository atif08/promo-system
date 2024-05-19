<?php

namespace App\Models\AmazonReports;

use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class DailySalesTraffic
 * @package App\Models
 * @property int id
 * @property int user_id
 * @property Carbon date
 * @property int product_id
 * @property integer units_ordered
 * @property integer units_ordered_b2b
 * @property double ordered_product_sales
 * @property double ordered_product_sales_b2b
 * @property integer total_order_items
 * @property integer total_order_items_b2b
 * @property integer browser_sessions
 * @property integer browser_sessions_b2b
 * @property integer mobile_app_sessions
 * @property integer mobile_app_sessions_b2b
 * @property integer sessions
 * @property integer sessions_b2b
 * @property double browser_session_percentage
 * @property double browser_session_percentage_b2b
 * @property double mobile_app_session_percentage
 * @property double mobile_app_session_percentage_b2b
 * @property double session_percentage
 * @property double session_percentage_b2b
 * @property integer browser_page_views
 * @property integer browser_page_views_b2b
 * @property integer mobile_app_page_views
 * @property integer mobile_app_page_views_b2b
 * @property integer page_views
 * @property integer page_views_b2b
 * @property double browser_page_views_percentage
 * @property double browser_page_views_percentage_b2b
 * @property double mobile_app_page_views_percentage
 * @property double mobile_app_page_views_percentage_b2b
 * @property double page_views_percentage
 * @property double page_views_percentage_b2b
 * @property double buy_box_percentage
 * @property double buy_box_percentage_b2b
 * @property double unit_session_percentage
 * @property double unit_session_percentage_b2b
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property User user
 * @property User product
 */
class DailySalesTraffic extends Model {

    protected $table = 'daily_sales_traffic';

    protected $fillable = [
        'user_id',
        'date',
        'product_id',
        // Sales Data
        'units_ordered',
        'units_ordered_b2b',
        'ordered_product_sales',
        'ordered_product_sales_b2b',
        'total_order_items',
        'total_order_items_b2b',
        // Traffic Data
        'browser_sessions',
        'browser_sessions_b2b',
        'mobile_app_sessions',
        'mobile_app_sessions_b2b',
        'sessions',
        'sessions_b2b',
        'browser_session_percentage',
        'browser_session_percentage_b2b',
        'mobile_app_session_percentage',
        'mobile_app_session_percentage_b2b',
        'session_percentage',
        'session_percentage_b2b',
        'browser_page_views',
        'browser_page_views_b2b',
        'mobile_app_page_views',
        'mobile_app_page_views_b2b',
        'page_views',
        'page_views_b2b',
        'browser_page_views_percentage',
        'browser_page_views_percentage_b2b',
        'mobile_app_page_views_percentage',
        'mobile_app_page_views_percentage_b2b',
        'page_views_percentage',
        'page_views_percentage_b2b',
        'buy_box_percentage',
        'buy_box_percentage_b2b',
        'unit_session_percentage',
        'unit_session_percentage_b2b'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo {
        return $this->belongsTo(Product::class);
    }
}
