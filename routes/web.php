<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\StructureController;
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
    return view('login');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::prefix('/dashboard')->group(function () {
    Route::prefix('events')->name('event.')->group(function () {
        Route::get('/', [EventController::class, 'index'])->name('list');
        Route::get('/create', [EventController::class, 'create'])->name('create');
        Route::post('/add', [EventController::class, 'store'])->name('add');
        Route::get('/{event}', [EventController::class, 'edit'])->name('edit');
        Route::put('/{event}', [EventController::class, 'update'])->name('update');
        Route::delete('/{event}/delete', [EventController::class, 'destroy'])->name('delete');
    });
    Route::prefix('structures')->name('structure.')->group(function () {
        Route::get('/', [StructureController::class, 'index'])->name('list');
        Route::get('/create', [StructureController::class, 'create'])->name('create');
        Route::post('/add', [StructureController::class, 'store'])->name('store');
        Route::get('/{structure}', [StructureController::class, 'edit'])->name('edit');
        Route::put('/{structure}', [StructureController::class, 'update'])->name('update');
        Route::delete('/{structure}', [StructureController::class, 'destroy'])->name('delete');
    });
    Route::prefix('partners')->name('partner.')->group(function () {
        Route::get('/partners', [PartnerController::class, 'index'])->name('list');
        Route::get('/create', [PartnerController::class, 'create'])->name('create');
        Route::post('/add', [PartnerController::class, 'store'])->name('store');
        Route::get('/{partner}', [PartnerController::class, 'edit'])->name('edit');
        Route::put('/{partner}', [PartnerController::class, 'update'])->name('update');
        Route::delete('/{partner}/delete', [PartnerController::class, 'destroy'])->name('delete');
    });
    Route::prefix('status')->name('status.')->group(function () {
        Route::get('/', [StatusController::class, 'index'])->name('list');
        Route::get('/create', [StatusController::class, 'create'])->name('create');
        Route::post('/create', [StatusController::class, 'store'])->name('store');
        Route::get('/{status}', [StatusController::class, 'edit'])->name('edit');
        Route::put('/{status}', [StatusController::class, 'update'])->name('update');
        Route::delete('/{status}/delete', [StatusController::class, 'destroy'])->name('delete');
    });
});










require __DIR__ . '/auth.php';
