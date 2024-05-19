<?php

use App\AmazonSpClients\ReportsApiClient;
use App\Jobs\AmazonProducts\GetProductCatalogJob;
use App\Jobs\AmazonReports\CreateReportsJob;
use App\Jobs\AmazonReports\ProcessReportJob;
use App\Jobs\AmazonReports\RequestReportJob;
use App\Models\AmazonReports\AmazonReport;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;

Artisan::command('products:catalog {user}', function () {
    /** @var User $user */
    $user = User::query()->findOrFail($this->argument('user'));
    (new GetProductCatalogJob($user))
        ->processJob();
});

Artisan::command('reports:create {user} {report_type}', function () {
    /** @var User $user */
    $user = User::query()->findOrFail($this->argument('user'));
    (new CreateReportsJob($user))
        ->setReportType($this->argument('report_type'))
        ->processJob();
});

Artisan::command('reports:request {report_id}', function () {
    /** @var AmazonReport $report */
    $report = AmazonReport::query()->findOrFail($this->argument('report_id'));
    $job = new RequestReportJob($report->user);
    $job->executeReportJob($report);
});

Artisan::command('reports:reprocess {report_id}', function () {
    /** @var AmazonReport $report */
    $report = AmazonReport::query()->findOrFail($this->argument('report_id'));
    $job = new ProcessReportJob($report->user);
    $job->executeReportJob($report);
});

Artisan::command('reports:raw_request {user_id} {report_type} {--start_date=} {--end_date=}', function () {
    /** @var User $user */
    $user = User::query()->findOrFail($this->argument('user_id'));

    $client = new ReportsApiClient($user);

    $config = config('reports.' . $this->argument('report_type'));

    $start_date = ($start_date = $this->option('start_date')) ? Carbon::parse($start_date)->startOfDay() : null;
    $end_date = ($end_date = $this->option('end_date')) ? Carbon::parse($end_date)->endOfDay() : null;

    $request_info = $client->createReport(
        $config['report_type'],
        to_array($user->marketplace->marketplace_id),
        $start_date,
        $end_date,
        ($config['report_options'] ?? null)
    );

    $response = json_decode($request_info->__toString(), true);

    console_log($response);
});

Artisan::command('reports:raw_status {user_id} {report_id}', function () {
    /** @var User $user */
    $user = User::query()->findOrFail($this->argument('user_id'));

    $client = new ReportsApiClient($user);

    $report_info = $client->getReport($this->argument('report_id'));

    $response = json_decode($report_info->__toString(), true);

    console_log($response);
});

Artisan::command('reports:raw_document {user_id} {document_id}', function () {
    /** @var User $user */
    $user = User::query()->findOrFail($this->argument('user_id'));

    $client = new ReportsApiClient($user);

    [$report_data, $response_headers] = $client->getReportDocument($this->argument('document_id'));

    if (is_array($report_data)) {
        console_log($report_data);
        return;
    }

    $content_type = $response_headers['Content-Type'][0];
    $charset = ($content_type === 'text/plain') ? 'UTF-8' : explode('=', $content_type)[1];

    fseek($report_data, 0);

    $readNextRow = function () use (&$report_data, $charset) {
        if ($row = fgets($report_data)) {
            if ($charset && $charset !== 'UTF-8') {
                $row = mb_convert_encoding($row, 'UTF-8', $charset);
            }
            return str_getcsv($row, "\t", "\n", "\b");
        }
        return [];
    };

    while (!feof($report_data)) {
        $row = $readNextRow();
        if (!$row) continue;
        console_log($row);
    }
});
