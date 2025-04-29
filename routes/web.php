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
    Route::resource('at-software', \App\Http\Controllers\ATSoftwareController::class);
    Route::resource('provisions', \App\Http\Controllers\ProvisionController::class);
    Route::resource('loans', \App\Http\Controllers\LoanController::class);
    Route::resource('sessions', \App\Http\Controllers\SessionController::class);
    
    Route::get('/sessions/{session}/add-provision', [\App\Http\Controllers\SessionController::class, 'addProvision'])->name('sessions.add-provision');
    Route::post('/sessions/{session}/provisions', [\App\Http\Controllers\SessionController::class, 'storeProvision'])->name('sessions.store-provision');
    Route::get('/sessions/{session}/add-software-provision', [\App\Http\Controllers\SessionController::class, 'addSoftwareProvision'])->name('sessions.add-software-provision');
    Route::post('/sessions/{session}/software-provisions', [\App\Http\Controllers\SessionController::class, 'storeSoftwareProvision'])->name('sessions.store-software-provision');
    Route::get('/sessions/{session}/add-wishlist-item', [\App\Http\Controllers\SessionController::class, 'addWishlistItem'])->name('sessions.add-wishlist-item');
    Route::post('/sessions/{session}/wishlist-items', [\App\Http\Controllers\SessionController::class, 'storeWishlistItem'])->name('sessions.store-wishlist-item');
    
    Route::patch('/loans/{loan}/return', [\App\Http\Controllers\LoanController::class, 'markAsReturned'])->name('loans.return');
    Route::patch('/loans/{loan}/lost', [\App\Http\Controllers\LoanController::class, 'markAsLost'])->name('loans.lost');
});

require __DIR__.'/auth.php';
