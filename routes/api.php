<?php

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

Route::prefix('/ad')->controller(\App\Http\Controllers\Api\AdController::class)->group(function () {
    Route::post('/', 'create');
    Route::get('/{id}', 'read');
    Route::post('/{id}', 'update');
    //Route::delete('/{id}', 'delete');
    Route::get('/', 'list');
});
