<?php

use App\Http\Controllers\CompteController;
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

Route::post('/depot/{compte_id}', [CompteController::class,'depot'])->name('compte.depot');
Route::post('/retrait/{compte_id}', [CompteController::class,'retrait'])->name('compte.retrait');
Route::post('/compte/{source_id}/transfert', [CompteController::class,'transfert'])->name('compte.transfert');


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
