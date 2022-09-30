<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\KeuanganController;
use App\Http\Controllers\Api\SubCategoryController;
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
// Data public
Route::group(['prefix' => 'category'], function() {
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('{id}/subcategory', [SubCategoryController::class, 'index']);
});
Route::get('subcategory/select', [SubCategoryController::class, 'selectSubCategory']);

Route::group(['prefix' => 'auth'], function() {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
});

Route::group(['middleware' => 'sanctum'], function() {
    Route::group(['prefix' => 'dashboard'], function() {
        Route::get('/', [DashboardController::class, 'index']);
    });

    Route::group(['prefix' => 'category'], function() {
        Route::get('/{id}', [CategoryController::class, 'show']);
        Route::post('/', [CategoryController::class, 'store']);
        Route::put('update', [CategoryController::class, 'update']);
        Route::delete('delete', [CategoryController::class, 'delete']);
        Route::group(['prefix' => 'subcategory'], function() {
            Route::post('/', [SubCategoryController::class, 'store']);
            Route::put('update', [SubCategoryController::class, 'update']);
            Route::delete('delete', [SubCategoryController::class, 'delete']);
        });
    });
    Route::group(['prefix' => 'keuangan'], function() {
        Route::get('/', [KeuanganController::class, 'getKeuanganAll']);
        Route::get('/show/{id}', [KeuanganController::class, 'show']);
        Route::get('bulanan', [KeuanganController::class, 'getKeuanganBulanan']);
        Route::post('storeHarian', [KeuanganController::class, 'storeKeuanganHarian']);
        Route::put('update', [KeuanganController::class, 'update']);
        Route::delete('delete', [KeuanganController::class, 'delete']);
    });
    Route::get('auth/check-token', [AuthController::class, 'checkToken']);
    Route::post('auth/logout', [AuthController::class, 'logout']);
});
