<?php

use AmazonSellingPartner\Model\Sellers\Participation;
use App\AmazonSpClients\SellersApiClient;
use App\Jobs\AmazonReports\CreateReportsJob;
use App\Jobs\AmazonReports\ProcessReportJob;
use App\Jobs\AmazonReports\RequestReportJob;
use App\Models\AmazonReports\AmazonReport;
use App\Models\Marketplace;
use App\Models\SpToken;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
//    $this->comment(Inspiring::quote());
    $user = User::query()->find(10);

//    AmazonReport::addRequest($user, AmazonReport::GET_MERCHANT_LISTINGS_DATA);
//    RequestReportJob::dispatchSync($user);
//    ProcessReportJob::dispatchSync($user);

})->purpose('Display an inspiring quote');

Artisan::command('participation {user_id}', function () {

    /** @var User $user */

    $user = User::query()->find($this->argument('user_id'));

    $client = new SellersApiClient($user, $user->getParent()->connection->refresh_token);
//    $client->getSellingPartnerSDK();
    $response = $client->getAccessToken($client->getSellingPartnerSDK());

    /** @var Participation $participations */

    foreach ($client->listParticipations() as $participation) {
        /** @var Marketplace $marketplace */
        $marketplace = Marketplace::getById($participation->getMarketplace()->getId());
//        if (!$marketplace || $marketplace->region_code !== $region) {
//            continue;
//        }
        if (!$marketplace) {
            continue;
        }

        /** @var User $account */

        $account = $user->registerSeller($marketplace);

        SpToken::query()->updateOrCreate([
            'user_id' => $account->id
        ], [
            'access_token'    => $response->token(),
            'refresh_token'   => $response->refreshToken(),
            'token_type'      => $response->type(),
            'expires_at'      => Carbon::now()->addSeconds(3000), // deliberately kept 600 secs less
            'last_updated_at' => Carbon::now()
        ]);
    }

})->purpose('Display an inspiring quote');



Artisan::command('dispatch {user_id}', function (Schedule $schedule) {
    $user = User::query()->find($this->argument('user_id'));


//    $job = (new CreateReportsJob($user))
//        ->setReportType(AmazonReport::SALES_AND_TRAFFIC_REPORT)
//        ->setStartFromDate(Carbon::now()->subDays(15)->startOfDay());
    CreateReportsJob::dispatchSync($user);
//    Dispach::($job);
//        $schedule->call(function () {
//            $this->delayDispatchJob(User::getSpCallables(), 300, function (User $user, $delay) {
//                $job = (new CreateReportsJob($user))
//                    ->setReportType(AmazonReport::SALES_AND_TRAFFIC_REPORT)
//                    ->setStartFromDate(Carbon::now()->subDays(15)->startOfDay());
//                dispatch($job)->delay($delay);
//            });
//        })->dailyAt('09:00');
//
//        $schedule->call(function () {
//            $this->delayDispatchJob(User::getSpCallables(), 900, function (User $user, $delay) {
//                dispatch(new RequestReportJob($user))->delay($delay);
//            });
//        })->everyFifteenMinutes();
//
//        $schedule->call(function () {
//            $this->delayDispatchJob(User::getSpCallables(), 900, function (User $user, $delay) {
//                dispatch(new ProcessReportJob($user))->delay($delay);
//            });
//        })->everyFifteenMinutes();


})->purpose('Display an inspiring quote');
