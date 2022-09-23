<?php

use App\Http\Controllers\API\ContactController;
use App\Http\Controllers\Apis;
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



Route::get('/contact-list', [ContactController::class, 'index']);
Route::post('/add-contact', [ContactController::class, 'store']);
Route::get('/edit-contact/{id}', [ContactController::class, 'edit']);
Route::put('/update-contact/{id}', [ContactController::class, 'update']);
Route::delete('/delete-contact/{id}', [ContactController::class, 'destroy']);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('/register', [Apis::class, 'register']);

Route::post('/login', [Apis::class, 'login']);

Route::get('/login', [Apis::class, 'login'])->name('login');

Route::middleware('auth:api')->get('/welcome', [Apis::class, 'welcome']);
