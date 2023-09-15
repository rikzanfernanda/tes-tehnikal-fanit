<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PresenceController;
use App\Http\Middleware\ApiMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

Route::middleware([ApiMiddleware::class])->group(function () {
    Route::controller(PresenceController::class)->group(function () {
        Route::get('/presences', 'index')->name('presences.index');

        Route::post('/presences', 'createPresence')->name('presences.create');

        Route::post('/approve', 'isApprove')->name('presences.approve');
    });
});
