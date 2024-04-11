<?php

use App\Http\Controllers\ApiWhatsappController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(ApiWhatsappController::class)->as('whatsapp.')->group(function () {
    Route::post('/whatsapp/getqr', 'getqr')->name('getqr');
});
