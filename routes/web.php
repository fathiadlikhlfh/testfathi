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

Route::get('/tesfathi', function () {
    return view('tes');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::get('admin', function() {
//     return '<h1>Helo Admin</h1>';
// })->middleware(['auth', 'verified','role:admin']);

Route::get('admin_dashboard', function () {
    return view('session.admindashboard');
})->middleware(['auth', 'verified', 'role:admin'])->name('admin_dashboard');

Route::get('penulis', function() {
    return '<h1>Helo Penulis</h1>';
})->middleware(['auth', 'verified','role:penulis|admin']);

Route::get('tulisan', function() {
    return view('tes');
})->middleware(['auth', 'verified','role_or_permission:lihat-tulisan|admin']);

require __DIR__.'/auth.php';