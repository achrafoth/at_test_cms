<?php

use App\Http\Controllers\ProfileController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::resource('clients', \App\Http\Controllers\ClientController::class);
    Route::resource('trusted-specialists', \App\Http\Controllers\TrustedSpecialistController::class);
    Route::resource('at-experts', \App\Http\Controllers\ATExpertController::class);
    Route::resource('at-equipment', \App\Http\Controllers\ATEquipmentController::class);
    Route::resource('provisions', \App\Http\Controllers\ProvisionController::class);
    Route::resource('loans', \App\Http\Controllers\LoanController::class);
    Route::resource('sessions', \App\Http\Controllers\SessionController::class);
    
    Route::patch('/loans/{loan}/return', [\App\Http\Controllers\LoanController::class, 'markAsReturned'])->name('loans.return');
    Route::patch('/loans/{loan}/lost', [\App\Http\Controllers\LoanController::class, 'markAsLost'])->name('loans.lost');
});

require __DIR__.'/auth.php';
