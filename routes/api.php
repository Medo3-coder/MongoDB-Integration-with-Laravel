<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MongoDBController;

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


Route::post('/entity-threads', [MongoDBController::class, 'storeEntityThread']);
Route::post('/messages', [MongoDBController::class, 'storeMessage']);
Route::get('/test-mongo-connection', [MongoDBController::class, 'testMongoConnection']);

