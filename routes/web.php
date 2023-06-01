<?php

use App\Http\Controllers\Admin\AdminEventController as AdminEventController;
use App\Http\Controllers\NumberOfParticipantsController;
use App\Http\Controllers\ProfileController,
    App\Http\Controllers\EventController,
    App\Http\Controllers\StatusController,
    App\Http\Controllers\StructureController;
use App\Http\Controllers\UserController;
use Barryvdh\Debugbar\DataCollector\EventCollector;
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

Route::redirect('/', '/login');

Route::middleware('auth')->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    Route::prefix('/dashboard')->group(function () {
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile/destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::middleware('admin')->group(function () {
            /* Route::prefix('events')->name('admin.event.')->group(function () {
                Route::get('/', [AdminEventController::class, 'index'])->name('list');
            }); */

            Route::prefix('structures')->name('admin.structure.')->group(function () {
                Route::get('/', [StructureController::class, 'index'])->name('list');
                Route::get('/create', [StructureController::class, 'create'])->name('create');
                Route::post('/store', [StructureController::class, 'store'])->name('store');
                Route::get('/{structure}/edit', [StructureController::class, 'edit'])->name('edit');
                Route::put('/{structure}/update', [StructureController::class, 'update'])->name('update');
                Route::delete('/{structure}/destroy', [StructureController::class, 'destroy'])->name('destroy');
            });

            Route::prefix('status')->name('admin.status.')->group(function () {
                Route::get('/', [StatusController::class, 'index'])->name('list');
                Route::get('/create', [StatusController::class, 'create'])->name('create');
                Route::post('/store', [StatusController::class, 'store'])->name('store');
                Route::get('/{status}/edit', [StatusController::class, 'edit'])->name('edit');
                Route::put('/{status}/update', [StatusController::class, 'update'])->name('update');
                Route::delete('/{status}/destroy', [StatusController::class, 'destroy'])->name('destroy');
            });

            Route::prefix('users')->name('admin.users.')->group(function () {
                Route::get('/', [UserController::class, "index"])->name('list');
                Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
                Route::put('/{user}/update', [UserController::class, 'update'])->name('update');
                Route::delete('/{user}/destroy', [UserController::class, 'destroy'])->name('destroy');
            });

            Route::prefix('numberOfParticipants')->name('admin.numberOfParticipants.')->group(function () {
                Route::get('/', [NumberOfParticipantsController::class, 'index'])->name('list');
                Route::get('/create', [NumberOfParticipantsController::class, 'create'])->name('create');
                Route::post('/store', [NumberOfParticipantsController::class, 'store'])->name('store');
                Route::get('/{numberOfParticipant}/edit', [NumberOfParticipantsController::class, 'edit'])->name('edit');
                Route::put('/{numberOfParticipant}/update', [NumberOfParticipantsController::class, 'update'])->name('update');
                Route::delete('/{numberOfParticipant}/destroy', [NumberOfParticipantsController::class, 'destroy'])->name('destroy');
            });
        });

        Route::prefix('events')->name('userEvent.')->group(function () {
            Route::get('/', [EventController::class, 'index'])->name('all');
            Route::get('/filtered', [EventController::class, 'filteredEvents'])->name('filter');
            Route::get('/create', [EventController::class, 'create'])->name('create');
            Route::get('/my', [EventController::class, 'userContribution'])->name('my');
            Route::post('/add', [EventController::class, 'store'])->name('add');
            Route::get('/{event}/edit', [EventController::class, 'edit'])->name('edit');
            Route::put('/{event}/update', [EventController::class, 'update'])->name('update');
            Route::delete('/{event}/destroy', [EventController::class, 'destroy'])->name('destroy');
        });
    });
});

require __DIR__ . '/auth.php';
