<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\AuthorController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\SourceController;
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
Route::get('sources',[SourceController::class,'index']);
Route::get('categories',[CategoryController::class,'index']);
Route::any('articles',[ArticleController::class,'create']);
Route::get('articles-with-key/{keyword?}',[ArticleController::class,'index']);
Route::get('articles',[ArticleController::class,'index']);
Route::middleware('auth:api')->group( function () {
    Route::get('preferences',[UserPreferenceController::class,'showByUserId']);
    Route::get('preference-articles/{keyword?}',[ArticleController::class,'showByUserPreference']);
    Route::post('preference',[UserPreferenceController::class,'store']);
});
