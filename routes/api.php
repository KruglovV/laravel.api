<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\AuthController;

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

Route::post('/register', [AuthController::class, 'register']);

Route::get('books', [BookController::class, 'getAllBooks']);
Route::get('books/{id}', [BookController::class, 'getBook']);
Route::post('books', [BookController::class, 'createBook']);
Route::put('books/{id}', [BookController::class, 'updateBook']);
Route::delete('books/{id}', [BookController::class, 'deleteBook']);
