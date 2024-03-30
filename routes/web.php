<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PermissionController;

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
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->middleware('auth')->group(function () {
//     Route::get('edit/{user}', 'profileEdit')->name('edit');
//     Route::post('update', 'profileUpdate')->name('update');
// });

Route::controller(ModuleController::class)->prefix('module')->name('module.')->middleware('auth')->group(function () {
    Route::get('index', 'index')->name('index');
    Route::get('create', 'create')->name('create');
    Route::post('store', 'store')->name('store');
    Route::get('edit/{module}', 'edit')->name('edit');
    Route::post('update/{module}', 'update')->name('update');
    Route::post('destroy/{module}', 'destroy')->name('destroy');
});
Route::controller(PermissionController::class)->prefix('permission')->name('permission.')->middleware('auth')->group(function () {
    Route::get('index', 'index')->name('index');
    Route::get('create', 'create')->name('create');
    Route::post('store', 'store')->name('store');
    Route::get('edit/{permission}', 'edit')->name('edit');
    Route::post('update/{permission}', 'update')->name('update');
    Route::post('destroy/{permission}', 'destroy')->name('destroy');
});
Route::controller(RoleController::class)->prefix('role')->name('role.')->middleware('auth')->group(function () {
    Route::get('index', 'index')->name('index');
    Route::get('create', 'create')->name('create');
    Route::post('store', 'store')->name('store');
    Route::get('edit/{role}', 'edit')->name('edit');
    Route::post('update/{role}', 'update')->name('update');
    Route::post('destroy/{role}', 'destroy')->name('destroy');
});
Route::controller(UserController::class)->prefix('user')->name('user.')->middleware('auth')->group(function () {
    Route::get('index', 'index')->name('index');
    Route::get('create', 'create')->name('create');
    Route::post('store', 'store')->name('store');
    Route::get('edit/{user}', 'edit')->name('edit');
    Route::post('update/{user}', 'update')->name('update');
    Route::post('destroy/{user}', 'destroy')->name('destroy');
    Route::post('status', 'userStatus')->name('status');
});

require __DIR__ . '/auth.php';
