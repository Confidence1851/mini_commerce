<?php

use App\Http\Controllers\Web\ActivityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::post('/provider/credit', [ActivityController::class , "receiveMoneyFromProvider"])->name("provider.credit");
// Route::post('/provider/debit', [ActivityController::class , "sendMoneyToProvider"])->name("provider.debit");

