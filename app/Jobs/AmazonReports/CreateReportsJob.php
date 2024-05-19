<?php

namespace App\Jobs\AmazonReports;

use App\Enums\UserTypeEnum;
use App\Jobs\BaseJob;
use App\Models\AmazonReports\AmazonReport;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateReportsJob extends BaseJob implements ShouldQueue {

	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var string */
    protected $report_type;
	/** @var Carbon */
	protected $start_from;
	/** @var Carbon */
	protected $end_at;
    /** @var array */
    protected $config;
	/** @var bool */
	protected $force_end = false;

    public function setReportType($report_type): self {
        $this->report_type = $report_type;
        return $this;
    }

	public function setStartFromDate($start_from): self {
		$this->start_from = $start_from;
		$this->force_end = true;
		return $this;
	}

	public function setEndAtDate($end_at): self {
		$this->end_at = $end_at;
		$this->force_end = true;
		return $this;
	}

	/**
	 * @throws Exception
	 */
	public function processJob() {
        $this->report_type = AmazonReport::SALES_AND_TRAFFIC_REPORT;

        if (!$this->report_type) {
            console_log('Please set the intended report-type');
            return;
        }

        if (!$this->user->hasSellingPartnerAccess()) {
            console_log('Selling Partner API access denied');
            return;
        }

        $this->config = config('reports.' . $this->report_type);
        if (($this->config['type'] == UserTypeEnum::SELLER() && !$this->user->isSeller())) {
            console_log('The user is not eligible for the intended report-type');
            return;
        }

        $this->scheduleReport();
	}

	protected function scheduleReport() {
        $is_real_time = ($this->config['real_time'] ?? false);
        if ($is_real_time) {
            console_log(implode(' | ', [$this->user->id, $this->report_type]));
            AmazonReport::addRequest($this->user, $this->report_type);
            return;
        }

        foreach ($this->getScheduleWindows() as $window) {
            [$start_time, $end_time, $process_at] = $window;
            console_log(implode(' | ', [$this->user->id, $this->report_type, $start_time->copy()->toDateTimeString(), $end_time->copy()->toDateTimeString()]));
            AmazonReport::addRequest($this->user, $this->report_type, $start_time, $end_time, $process_at);
        }
	}

    protected function getScheduleWindows() {
        $windows = [];

        $start_date = $this->getStartFromDate()->copy();
        $end_date = ($this->end_at ?: Carbon::now())->startOfDay();
        while ($start_date->lt($end_date)) {
            $start_time = $start_date->copy()->startOfDay();
            $end_time = $start_date->copy()->addDays($this->config['days_span'] ?? 0)->endOfDay();
            $process_at = $end_time->copy()->addSeconds($this->config['3600'] ?? 0);

            $windows[] = [$start_time, $end_time, $process_at];

            $start_date = $end_time->copy()->addSecond();
        }

        return $windows;
    }

	protected function getStartFromDate(): Carbon {
		if ($this->start_from) {
			return $this->start_from;
		}

		/** @var AmazonReport $last */
		if ($last = AmazonReport::getLastForUser($this->user, $this->report_type)) {
            return $last->end_date->addDay()->startOfDay();
        }

		return Carbon::now()->subDays($this->config['lookback_days'] ?? 15);
	}

}
