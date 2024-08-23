<?php

use App\Http\Controllers\LeadsController;
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

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth');

Route::get('/dashboard', [LeadsController::class, 'show'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('guest')->group(function () {

    Route::prefix('/leads')->group(function () {

        Route::post('/create', [LeadsController::class, 'create'])->name('create-lead');

    });

});

Route::middleware('auth')->group(function () {

    Route::prefix('/leads')->group(function () {

        Route::get('/status-counts', [LeadsController::class, 'statusCounts'])->name('leads.statusCounts');
        Route::put('/update-status', [LeadsController::class, 'updateStatus'])->name('leads.updateStatus');

        Route::get('/{id}', [LeadsController::class, 'getOnce'])->name('leads.getOnce');
        Route::patch('/{id}', [LeadsController::class, 'editLead'])->name('leads.editLead');
        Route::delete('/{id}', [LeadsController::class, 'deleteLead'])->name('leads.deleteLead');

    });

});


require __DIR__.'/auth.php';
