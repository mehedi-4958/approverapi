<?php

use App\Http\Controllers\ApprovalItemDetailController;
use App\Http\Controllers\ApprovalItemMasterController;
use App\Http\Controllers\UserController;
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

Route::group(['prefix' => 'v1'], function (){
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/register', [UserController::class, 'register']);
    Route::get('/profile', [UserController::class, 'profile'])->middleware('auth:api');
    Route::post('/change-password', [UserController::class, 'changePassword'])->middleware('auth:api');

    Route::get('/logout', [UserController::class, 'logout'])->middleware('auth:api');

    Route::post('create-item', [ApprovalItemMasterController::class, 'store']);
    Route::get('item-list', [ApprovalItemMasterController::class, 'index']);

    Route::get('pending-item', [ApprovalItemMasterController::class, 'showPending']);
    Route::get('approved-item', [ApprovalItemMasterController::class, 'showApproved']);
    Route::get('declined-item', [ApprovalItemMasterController::class, 'showDeclined']);
    Route::post('update-status', [ApprovalItemMasterController::class, 'update']);

    Route::post('create-item-details', [ApprovalItemDetailController::class, 'store']);
    Route::post('item-detail', [ApprovalItemDetailController::class, 'showDetail']);



});

//Route::apiResources([
//    '/approval-items' => ApprovalItemMaster::class,
//]);
