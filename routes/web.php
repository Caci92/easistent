<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseListController;
use App\Http\Controllers\PurchaseListItemController;
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

    Route::controller(PurchaseListController::class)->prefix('list')->group(function () {
        Route::get('/', 'index')->name('purchaseList.index');
        Route::get('/create', 'create')->name('purchaseList.create');
        Route::post('/store', 'store')->name('purchaseList.store');
        Route::get('/{purchaseList}/edit', 'edit')->name('purchaseList.edit');
        Route::put('/{purchaseList}/update', 'update')->name('purchaseList.update');
        Route::get('/{purchaseList}/destroy', 'destroy')->name('purchaseList.destroy');

        Route::controller(PurchaseListItemController::class)->group(function () {
            Route::get('/{purchaseList}/items', 'index')->name('purchaseListItem.index');
            Route::get('/{purchaseList}/items/create', 'create')->name('purchaseListItem.create');
            Route::post('/{purchaseList}/items/store', 'store')->name('purchaseListItem.store');
            Route::get('/{purchaseList}/items/{purchaseListItem}/edit', 'edit')->name('purchaseListItem.edit');
            Route::put('/{purchaseList}/items/{purchaseListItem}/update', 'update')->name('purchaseListItem.update');
            Route::get('/{purchaseList}/items/{purchaseListItem}/destroy', 'destroy')->name('purchaseListItem.destroy');
            Route::get('/{purchaseList}/items/{purchaseListItem}/completed', 'markCompleted')->name('purchaseListItem.markCompleted');
            Route::get('/{purchaseList}/items/{purchaseListItem}/not-completed', 'markNotCompleted')->name('purchaseListItem.markNotCompleted');
        });
    });
});

require __DIR__.'/auth.php';
