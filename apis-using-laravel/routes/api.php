<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/sorted/{string} ", [MainController::class, "sort"]);

Route::get("/getplace/{num} ", [MainController::class, "getNumPlace"]);

Route::get("/programer/{text} ", [MainController::class, "humanToProgramer"]);

Route::get("/math/{expression} ", [MainController::class, "calculate"]);
