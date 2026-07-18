<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

// Protected routes
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard (Task List)
    Route::get('/dashboard', [TaskController::class, 'index'])
        ->name('dashboard');

    // Add Task
    Route::get('/add', [TaskController::class, 'add'])
        ->name('add');

    Route::post('/store', [TaskController::class, 'store'])
        ->name('store');

    // Edit Task
    Route::get('/edit/{id}', [TaskController::class, 'edit'])
        ->name('edit');

    Route::post('/update/{id}', [TaskController::class, 'update'])
        ->name('update');

    // Delete Task
    Route::get('/delete/{id}', [TaskController::class, 'delete'])
        ->name('delete');

    // Update Status
    Route::post('/status/{id}', [TaskController::class, 'updateStatus'])
        ->name('status.update');


    //(Role Management)
    Route::get('/users', [UserController::class, 'index'])
       ->name('users');

    // Update Role
    Route::post('/role/{id}', [UserController::class, 'updateRole'])
        ->name('update.role');

    Route::get('/user-rights', [UserController::class, 'userRights'])
        ->name('user-rights');

        });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
