<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\BookController;
use App\Http\Controllers\API\AuthorController;
use App\Http\Controllers\API\ArticleController;
use App\Http\Controllers\API\UserPreferenceController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('register', [RegisterController::class, 'register']);
Route::post('login',  [RegisterController::class, 'login']);
Route::get('authors',[AuthorController::class,'index']);
Route::get('articles',[ArticleController::class,'create']);
Route::post('preference',[UserPreferenceController::class,'store']);
Route::middleware('auth:api')->group( function () {
    Route::get('books',[BookController::class,'index']);
    Route::post('books',[BookController::class,'store']);
    Route::get('books/{id}',[BookController::class,'show']);
    Route::put('books/{id}',[BookController::class,'update']);
    Route::delete('books/{id}',[BookController::class,'destroy']);
    // Route::get('authors',[AuthorController::class,'index']);
    Route::post('authors',[AuthorController::class,'store']);
    Route::get('authors/{id}',[AuthorController::class,'show']);
});
