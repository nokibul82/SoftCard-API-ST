<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\UserRelationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login',[AuthController::class,'login']);
Route::post('/register',[AuthController::class,'register']);

Route::post('/create',[CardController::class,'create']);
Route::get('/read',[CardController::class,'read']);
Route::get('/delete/{id}',[CardController::class,'delete']);
Route::get('/update/{id}',[CardController::class,'update']);

Route::post('/request',[UserRelationController::class,'request']);
Route::post('/accept',[UserRelationController::class,'accept']);
Route::post('/decline',[UserRelationController::class,'decline']);

Route::get('/getRequestList',[UserRelationController::class,'getRequestList']);
Route::get('/getPendingList',[UserRelationController::class,'getPendingList']);
