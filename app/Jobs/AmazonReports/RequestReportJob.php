<?php

namespace App\Jobs\AmazonReports;

use AmazonSellingPartner\Exception\ApiException;
use App\Models\AmazonReports\AmazonReport;
use Carbon\Carbon;
use Exception;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;

class RequestReportJob extends ReportParentJob {

    /** @var AmazonReport */
    protected $amazon_report;

    public function getNextBatch() {
        return AmazonReport::query()
            ->where('user_id', $this->getUser()->id)
            ->where('status', AmazonReport::STATUS_PENDING)
            ->where(function ($query) {
                $query->whereNull('process_at')
                    ->orWhere('process_at', '<=', Carbon::now());
            })
            ->whereNull('report_id')
            ->orderBy('end_date', 'DESC')
            ->limit(5)
            ->get();
    }

    /**
     * @throws ApiException
     * @throws JsonException
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function executeReportJob(AmazonReport $amazon_report) {
        $this->amazon_report = $amazon_report;

        if (!$this->_canExecute()) {
            console_log('Cannot request more than one at a time');
            $this->amazon_report->process_at = Carbon::now()->addMinutes(10);
        }

        console_log('Running Job for User ID: ' . $this->getUser()->id);

        $request_info = $this->getClient()->createReport(
            ...$amazon_report->getCreateReportParams());

        if ($request_info) {
            $this->amazon_report->update([
                'report_id'    => $request_info->getReportId(),
                'status'       => AmazonReport::STATUS_SUBMITTED,
                'last_checked' => Carbon::now(),
            ]);

            console_log(
                'Requested Amazon Report: ' . $this->amazon_report->id,
                $this->amazon_report->report_type,
                !$this->amazon_report->start_date ?: $this->amazon_report->start_date->toDateTimeString(),
                !$this->amazon_report->end_date ?: $this->amazon_report->end_date->toDateTimeString()
            );
        }
    }

    private function _canExecute(): bool {
//        switch ($this->amazon_report->report_type) {
//            case AmazonReport::FLAT_FILE_ORDERS:
//            case AmazonReport::FLAT_FILE_ALL_ORDERS:
//                return !$this->amazon_report->isAlreadySubmitted();
//        }

        return true;
    }
}
