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

Route::get('/dashboard/create-event', [EventController::class, 'create'])->name('add.event');
Route::post('/dashboard/create-event', [EventController::class, 'store'])->name('event.store');
Route::get('/dashboard/events', [EventController::class, 'index'])->name('event.list');
Route::get('dashboard/events/{event}', [EventController::class, 'edit'])->name('event.edit');
Route::put('dashboard/events/{event}', [EventController::class, 'update'])->name('event.update');
Route::delete('dashboard/events/{event}/delete', [EventController::class, 'destroy'])->name('event.destroy');

Route::get('/dashboard/structures', [StructureController::class, 'index'])->name('structure');
Route::get('/dashboard/add-structure', [StructureController::class, 'create'])->name('add.structure');
Route::post('/dashboard/add-structure', [StructureController::class, 'store'])->name('check.structure');
Route::get('dashboard/strucutures/{structure}', [StructureController::class, 'edit'])->name('structure.edit');
Route::put('dashboard/strucutures/{structure}', [StructureController::class, 'update'])->name('structure.update');
Route::delete('/dashboard/structures/{structure}/delete', [StructureController::class, 'destroy'])->name('structure.delete');

Route::get('/dashboard/partners', [PartnerController::class, 'index'])->name('partners.list');
Route::get('/dashboard/partners/create', [PartnerController::class, 'create'])->name('create.partner');
Route::post('/dashboard/partners/add', [PartnerController::class, 'store'])->name('partner.store');
Route::get('/dashboard/partners/{partner}', [PartnerController::class, 'edit'])->name('partner.edit');
Route::put('/dashboard/partners/{partner}', [PartnerController::class, 'update'])->name('partner.update');
Route::delete('/dashboard/partners/{partner}/delete', [PartnerController::class, 'destroy'])->name('partner.delete');

Route::get('/dashboard/status/', [StatusController::class, 'index'])->name('status.list');
Route::get('/dashboard/status/create', [StatusController::class, 'create'])->name('status.create');
Route::post('/dashboard/status/create', [StatusController::class, 'store'])->name('status.store');
Route::get('/dashboard/status/{status}', [StatusController::class, 'edit'])->name('status.edit');
Route::put('/dashboard/status/{status}', [StatusController::class, 'update'])->name('status.update');
Route::delete('/dashboard/status/{status}/delete', [StatusController::class, 'destroy'])->name('status.delete');



require __DIR__ . '/auth.php';
