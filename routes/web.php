<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\ItemController as ControllersItemController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Route::middleware(['auth', 'checklevel:admin'])->prefix('admin')->group(function () {


//     Route::resource('items', ControllersItemController::class);

// });
Route::middleware(['auth', 'checklevel:admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/items', [ControllersItemController::class, 'index'])->name('items.index');

    Route::get('/items/{item}/edit', [ControllersItemController::class, 'edit'])->name('items.edit');

    Route::put('/items/{item}', [ControllersItemController::class, 'update'])->name('items.update');

    Route::get('/items/create', [ControllersItemController::class, 'create'])->name('items.create');
    Route::post('/items', [ControllersItemController::class, 'store'])->name('items.store');
    Route::delete('/items/{item}', [ControllersItemController::class, 'destroy'])->name('items.destroy');
    Route::resource('categories',CategoryController::class);


});
Route::get('/security-check', function () {
    $maliciousData = "<script>alert('XSS Berhasil! Sistem Anda rentan.');</script>";
    return view('security-check', ['data' => $maliciousData]);
});
require __DIR__ . '/auth.php';
