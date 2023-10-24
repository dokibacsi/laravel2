<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CopyController;
use App\Http\Controllers\LendingController;
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
});

Route::middleware( ['admin'])->group(function () {
    Route::apiResource('/api/users', UserController::class);
});

Route::middleware('auth.basic')->group(function () {
    Route::apiResource('/books', BookController::class);
    Route::apiResource('/copies', CopyController::class);
    Route::get('/with/copy_one_with', [BookController::class, 'copyOneWith']);
    Route::get('with/lone_with', [LendingController::class, 'userOneWith']);
    Route::get('with/booLend_with', [CopyController::class, 'BookLendingWith']);
});

require __DIR__.'/auth.php';
