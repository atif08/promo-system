<?php

use App\Enums\UserTypeEnum;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ConnectionController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\PromoCodes\PromoCodesController;
use App\Http\Controllers\Settings\ConnectionsController;
use App\Http\Controllers\Settings\ProfileController;
use App\Http\Controllers\SpTokenController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPromoCodesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');

});

Route::get('/checkout', function () {
    return view('checkout');

});

//Route::get('/get-catalog',function(){
//    $user = \App\Models\User::query()->findOrFail(10);
//    (new \App\Jobs\AmazonProducts\GetProductCatalogJob($user))
//        ->processJob();
//});

Route::prefix('profile')->name('profile.')->group(function () {

    Route::get('/', [ProfileController::class, 'getProfile'])->name('form');
    Route::post('/{user}', [ProfileController::class, 'postProfile'])->name('post');
    Route::post('/password/{user}', [ProfileController::class, 'postChangePassword'])->name('password.post');

});

Route::get('/user-promo-codes', UserPromoCodesController::class);
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
Route::resource('/promo-codes', PromoCodesController::class);
Route::resource('/users', UserController::class)->middleware(['checkUserType:admin']);

Route::prefix('general')->group(function () {
    Route::get('/menus', [GeneralController::class, 'getNavigationMenu']);
    Route::get('/marketplaces', [GeneralController::class, 'getMarketplaceSwitcher']);
    Route::post('/marketplace', [GeneralController::class, 'postChangeMarketplace']);
});
Auth::routes();
