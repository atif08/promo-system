<?php

namespace App\Jobs\AmazonReports;

use App\AmazonSpClients\ReportsApiClient;
use App\Jobs\BaseJob;
use App\Models\AmazonReports\AmazonReport;
use App\Models\User;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

abstract class ReportParentJob extends BaseJob implements ShouldQueue {

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var ReportsApiClient */
    protected $client;

    public function __construct(User $user) {
        parent::__construct($user);
    }

    /**
     * @throws Exception
     */
    public function getClient(): ReportsApiClient {
        $this->client = $this->client ?: new ReportsApiClient($this->user);
        return $this->client;
    }

    public function getNextBatch() {
        return null;
    }

    public function executeReportJob(AmazonReport $amazon_report) {
    }

    public function processJob() {
        if (!$this->user->hasSellingPartnerAccess()) {
            console_log('Selling Partner API access denied');
            return;
        }

        /** @var AmazonReport $amazon_report */
        foreach ($this->getNextBatch() as $amazon_report) {
            $this->executeReportJob($amazon_report);
        }
    }

}
