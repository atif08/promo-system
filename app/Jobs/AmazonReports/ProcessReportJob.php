<?php

namespace App\Jobs\AmazonReports;

use AmazonSellingPartner\Exception\ApiException;
use AmazonSellingPartner\Model\Reports\Report;
use App\AmazonReports\AmazonReportParent;
use App\Models\AmazonReports\AmazonReport;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Client\ClientExceptionInterface;

class ProcessReportJob extends ReportParentJob {

    /** @var AmazonReport */
    protected $amazon_report;

    public function getNextBatch() {
        return AmazonReport::query()
            ->where('user_id', $this->getUser()->id)
            ->where('status', '!=', AmazonReport::STATUS_PENDING)
            ->where('processed', false)
            ->where('last_updated_at', '<', Carbon::parse('5 minutes ago'))
            ->orderBy('end_date', 'DESC')
            ->limit(5)
            ->get();
    }

    /**
     * @throws GuzzleException
     * @throws ApiException
     * @throws Exception
     * @throws ClientExceptionInterface
     */
    public function executeReportJob(AmazonReport $amazon_report) {
		$this->amazon_report = $amazon_report;

        if (!$this->_canExecute()) {
            console_log('Report is not ready for processing');
            return;
        }

        if ($this->_isDelayed()) {
            console_log('This report has been delayed');
            return;
        }

        [$report_data, $response_headers] = $this->getClient()->getReportDocument($this->amazon_report->document_id);

        $content_type = $response_headers['Content-Type'][0];
        $charset = ($content_type === 'text/plain') ? 'UTF-8' : explode('=', $content_type)[1];

        $class = $this->amazon_report->getReportClass();
        /** @var AmazonReportParent $handler */
        $handler = new $class($this->amazon_report);
        $handler->setCharset($charset);
        $handler->process($report_data);
    }

    /**
     * @throws ApiException
     * @throws Exception
     * @throws GuzzleException
     * @throws ClientExceptionInterface
     */
    private function _canExecute(): bool {
        if ($this->amazon_report->document_id ||
            $this->amazon_report->status == Report::PROCESSING_STATUS_DONE) {
            return true;
        }

        if (!in_array($this->amazon_report->status, [
            AmazonReport::STATUS_SUBMITTED,
            Report::PROCESSING_STATUS_IN_PROGRESS,
            Report::PROCESSING_STATUS_IN_QUEUE
        ])) {
            return false;
        }

        [$status, $document_id, $available_at] = $this->getClient()->getReportStatus($this->amazon_report->report_id);
        $this->amazon_report->status = $status;
        $this->amazon_report->last_updated_at = Carbon::now();

        console_log('Report Status: ' . $status);

        switch ($this->amazon_report->status) {
            case Report::PROCESSING_STATUS_DONE:
                $this->amazon_report->available_at = $available_at ?: Carbon::now();
                $this->amazon_report->document_id = $document_id;
                break;
            case Report::PROCESSING_STATUS_FATAL:
            case Report::PROCESSING_STATUS_CANCELLED:
                $this->amazon_report->processed = 1;
                $this->amazon_report->reSchedule();
                break;
        }

        $this->amazon_report->save();
        $this->amazon_report->fresh();

        return ($status == Report::PROCESSING_STATUS_DONE);
    }

    private function _isDelayed(): bool {
        return false;

//        if ($this->amazon_report->report_type == AmazonReport::FBA_MYI_UNSUPPRESSED_INVENTORY) {
//            return false;
//        }
//
//        return AmazonReport::query()
//            ->where('user_id', $this->getUser()->id)
//            ->where('report_type', AmazonReport::FBA_MYI_UNSUPPRESSED_INVENTORY)
//            ->where('processed', 0)
//            ->exists();
    }
}
