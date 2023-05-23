<?php

use App\Http\Controllers\NumberOfParticipantsController;
use App\Http\Controllers\ProfileController,
    App\Http\Controllers\EventController,
    App\Http\Controllers\PartnerController,
    App\Http\Controllers\StatusController,
    App\Http\Controllers\StructureController;
use App\Http\Controllers\UserController;
use App\Models\NumberOfParticipants;
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
    return redirect('login');
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
        Route::put('/{event}/update', [EventController::class, 'update'])->name('update');
        Route::delete('/{event}/delete', [EventController::class, 'destroy'])->name('delete');
    });
    
    Route::prefix('structures')->name('structure.')->group(function () {
        Route::get('/', [StructureController::class, 'index'])->name('list');
        Route::get('/create', [StructureController::class, 'create'])->name('create');
        Route::post('/add', [StructureController::class, 'store'])->name('store');
        Route::get('/{structure}', [StructureController::class, 'edit'])->name('edit');
        Route::put('/{structure}/update', [StructureController::class, 'update'])->name('update');
        Route::delete('/{structure}', [StructureController::class, 'destroy'])->name('delete');
    });

    Route::prefix('status')->name('status.')->group(function () {
        Route::get('/', [StatusController::class, 'index'])->name('list');
        Route::get('/create', [StatusController::class, 'create'])->name('create');
        Route::post('/create', [StatusController::class, 'store'])->name('store');
        Route::get('/{status}', [StatusController::class, 'edit'])->name('edit');
        Route::put('/{status}/update', [StatusController::class, 'update'])->name('update');
        Route::delete('/{status}/delete', [StatusController::class, 'destroy'])->name('delete');
    });

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/users', [UserController::class, "index"])->name('list');
        Route::get('/{user}', [UserController::class, 'edit'])->name('edit');
        Route::put('/{user}/update', [UserController::class, 'update'])->name('update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('delete');
    });

    Route::prefix('numberOfParticipants')->name('numberOfParticipants.')->group(function () {
        Route::get('/', [NumberOfParticipantsController::class, 'index'])->name('list');
        Route::get('/create', [NumberOfParticipantsController::class, 'create'])->name('create');
        Route::post('/create', [NumberOfParticipantsController::class, 'store'])->name('store');
        Route::get('/{numberOfParticipant}', [NumberOfParticipantsController::class, 'edit'])->name('edit');
        Route::put('/{numberOfParticipant}/update', [NumberOfParticipantsController::class, 'update'])->name('update');
        Route::delete('/{numberOfParticipant}/delete', [NumberOfParticipantsController::class, 'destroy'])->name('delete');
    });
    
});

require __DIR__ . '/auth.php';
