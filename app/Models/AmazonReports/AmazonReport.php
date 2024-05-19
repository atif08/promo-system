<?php

namespace App\Models\AmazonReports;

use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class AmazonReport
 * @package App\Models\AmazonReports
 * @property int id
 * @property int user_id
 * @property string report_type
 * @property string report_id
 * @property string document_id
 * @property string status
 * @property boolean processed
 * @property Carbon start_date
 * @property Carbon end_date
 * @property Carbon process_at
 * @property Carbon available_at
 * @property Carbon last_updated_at
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property User user
 */
class AmazonReport extends Model {

    const SALES_AND_TRAFFIC_REPORT = 'GET_SALES_AND_TRAFFIC_REPORT';
    const GET_MERCHANT_LISTINGS_DATA = 'GET_MERCHANT_LISTINGS_DATA';

    const STATUS_PENDING = 'PENDING';
    const STATUS_SUBMITTED = 'SUBMITTED';

    protected $fillable = [
        'user_id',
        'report_type',
        'report_id',
        'document_id',
        'status',
        'processed',
        'start_date',
        'end_date',
        'process_at',
        'available_at',
        'last_updated_at'
    ];

    protected $casts = [
        'start_date'      => 'datetime',
        'end_date'        => 'datetime',
        'process_at'      => 'datetime',
        'available_at'    => 'datetime',
        'last_updated_at' => 'datetime',
        'created_at'      => 'datetime',
        'updated_at'      => 'datetime',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    /**
     * @param User $user
     * @param $report_type
     * @return Builder|Model|object|null
     */
    public static function getLastForUser(User $user, $report_type) {
        return self::query()
            ->where('user_id', $user->id)
            ->where('report_type', $report_type)
            ->orderBy('end_date', 'DESC')
            ->first();
    }

    /**
     * @param User $user
     * @param $report_type
     * @return Builder|Model|object|null
     */
    public static function getFirstForUser(User $user, $report_type) {
        return self::query()
            ->where('user_id', $user->id)
            ->where('report_type', $report_type)
            ->orderBy('start_date', 'ASC')
            ->first();
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getReportClass(): string {
        if ($class = config('reports.' . $this->report_type . '.class')) {
            return $class;
        }

        throw new Exception('Report implementation is missing for report ID: ' . $this->id);
    }

    public static function isMarketplaceEligible($marketplace, $report_type): bool {
        $config = config('reports.' . $report_type);

        if (isset($config['marketplaces'])) {
            return in_array($marketplace, $config['marketplaces']);
        }

        if (isset($config['not_for'])) {
            return !in_array($marketplace, $config['not_for']);
        }

        return true;
    }

    public function isAlreadySubmitted(): bool {
        return self::query()
            ->where('id', '<>', $this->id)
            ->where('report_type', $this->report_type)
            ->where('user_id', $this->user_id)
            ->where('status', '!=', self::STATUS_PENDING)
            ->where('processed', 0)
            ->exists();
    }

    public function reSchedule() {
        $pending = self::query()
            ->where('report_type', $this->report_type)
            ->where('user_id', $this->user_id)
            ->where('start_date', $this->start_date)
            ->where('end_date', $this->end_date)
            ->where('id', '<>', $this->id)
            ->where('processed', 0)
            ->exists();

        if (!$pending) {
            AmazonReport::addRequest($this->user, $this->report_type, $this->start_date, $this->end_date, $this->process_at);
        }
    }

    public static function addRequest(User $user, $report_type, Carbon $start_date = null, Carbon $end_date = null, Carbon $process_at = null) {
        if (!self::isMarketplaceEligible($user->marketplace->code, $report_type)) {
            console_log('This report-type is not available for this marketplace');
            return;
        }

        self::query()->create([
            'user_id'         => $user->id,
            'report_type'     => $report_type,
            'start_date'      => $start_date,
            'end_date'        => $end_date,
            'process_at'      => $process_at,
            'status'          => self::STATUS_PENDING,
            'last_updated_at' => Carbon::now()
        ]);
    }

    public static function hasPending($user, $report_type): bool {
        return self::query()->where([
            'user_id'     => $user->id,
            'report_type' => $report_type,
            'processed'   => 0,
        ])->exists();
    }

    public function getCreateReportParams(): array {
        $config = config('reports.' . $this->report_type);

        return [
            $config['report_type'] ?? $this->report_type,
            to_array($this->user->marketplace->marketplace_id),
            ($config['real_time'] ?? true) ? null : $this->start_date,
            ($config['real_time'] ?? true) ? null : $this->end_date,
            ($config['report_options'] ?? null)
        ];
    }
}
