<?php

use App\Http\Controllers\ClaimController;
use App\Http\Controllers\ClosingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('closing.index');
});

Route::get('/closing', [ClosingController::class, 'index'])->name('closing.index');
Route::post('/closing/generate-excel', [ClosingController::class, 'generateExcel'])->name('closing.generate-excel');

Route::get('/claim', [ClaimController::class, 'index'])->name('claim.index');
Route::post('/claim/generate-excel', [ClaimController::class, 'generateExcel'])->name('claim.generate-excel');
