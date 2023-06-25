<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookCategoryController;
use App\Http\Controllers\BookBorrowController;
use Illuminate\Support\Facades\Auth;

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

Route::post('auth/login', function (Request $request) {
    $credentials = $request->only('email', 'password');
    
    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        $tokenResult = $user->createToken('MyAppToken');
        $accessToken = $tokenResult->accessToken;
        $tokenType = 'Bearer';
        $expiresIn = $tokenResult->token->expires_at->timestamp;

        $response = [
            'user' => $user,
            'access_token' => $accessToken,
            'token_type' => $tokenType,
            'expires_in' => $expiresIn,
        ];

        return response()->json(['success'=> true, 'data' => $response], 200);
    }

    return response()->json(['error' => 'Unauthorized'], 401);

});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/books', [BookController::class, 'index']);
Route::post('/books', [BookController::class, 'store']);
Route::get('/books/{id}', [BookController::class, 'show']);
Route::put('/books/{id}', [BookController::class, 'update']);
Route::delete('/books/{id}', [BookController::class, 'destroy']);

Route::get('/categories', [BookCategoryController::class, 'index']);
Route::post('/categories', [BookCategoryController::class, 'store']);
Route::get('/categories/{id}', [BookCategoryController::class, 'show']);
Route::put('/categories/{id}', [BookCategoryController::class, 'update']);
Route::delete('/categories/{id}', [BookCategoryController::class, 'destroy']);



Route::get('/borrow-books', [BookBorrowController::class, 'index']);
Route::get('/borrow-books/unreturned', [BookBorrowController::class, 'unreturned']);
Route::post('/borrow-books', [BookBorrowController::class, 'store']);
Route::get('/borrow-books/{id}', [BookBorrowController::class, 'show']);
Route::put('/borrow-books/{id}', [BookBorrowController::class, 'update']);
Route::delete('/borrow-books/{id}', [BookBorrowController::class, 'destroy']);


// Route::group(['middleware' => 'auth:api'], function () {
//     Route::post('borrow-books', [BookBorrowController::class, 'store']);
//     Route::get('borrow-books/{id}', [BookBorrowController::class, 'show']);
//     Route::put('borrow-books/{id}', [BookBorrowController::class, 'update']);
//     Route::delete('borrow-books/{id}', [BookBorrowController::class, 'destroy']);
// });

// Route::middleware('auth:api')->group(function () {
//     Route::get('/categories', [BookCategoryController::class, 'index']);
//     Route::post('/categories', [BookCategoryController::class, 'store']);
//     Route::get('/categories/{category}', [BookCategoryController::class, 'show']);
//     Route::put('/categories/{category}', [BookCategoryController::class, 'update']);
//     Route::delete('/categories/{category}', [BookCategoryController::class, 'destroy']);
// });

// Route::middleware('auth:api')->group(function () {
//     Route::get('/books', [BookController::class, 'index']);
//     Route::post('/books', [BookController::class, 'store']);
//     Route::get('/books/{book}', [BookController::class, 'show']);
//     Route::put('/books/{book}', [BookController::class, 'update']);
//     Route::delete('/books/{book}', [BookController::class, 'destroy']);
// });



