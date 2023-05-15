<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
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
Route::get('/dashboard')->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard/create-event', [EventController::class, 'create'])->name('add.event');
Route::post('/dashboard/create-event', [EventController::class, 'store'])->name('event.store');
Route::get('/dashboard/events', [EventController::class, 'index'])->name('event.list');

Route::get('/dashboard/structures', [StructureController::class, 'index'])->name('structure');
Route::get('/dashboard/add-structure', [StructureController::class, 'create'])->name('add.structure');
Route::post('/dashboard/add-structure', [StructureController::class, 'store'])->name('check.structure');







require __DIR__ . '/auth.php';
