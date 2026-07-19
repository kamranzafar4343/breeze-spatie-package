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
    Route::middleware(['auth', 'permission:create tasks'])
    ->get('/add', [TaskController::class, 'add'])
        ->name('add');
    
    
    Route::post('/store', [TaskController::class, 'store'])
        ->name('store');

    // Edit Task
    Route::middleware(['auth', 'permission:edit tasks'])
    ->get('/edit/{id}', [TaskController::class, 'edit'])
        ->name('edit');

    Route::post('/update/{id}', [TaskController::class, 'update'])
        ->name('update');

    // Delete Task
    Route::middleware(['auth', 'permission:delete tasks'])
    ->get('/delete/{id}', [TaskController::class, 'delete'])
        ->name('delete');

    // Update Status
    Route::middleware(['auth', 'permission:update task status'])
    ->post('/status/{id}', [TaskController::class, 'updateStatus'])
        ->name('status.update');

    //(Show & update User Rights)
       Route::middleware(['auth','permission:manage users'])
    ->get('/users', [UserController::class,'index'])
    ->name('users');
    
    // Update Role for a User
    Route::post('/role/{id}', [UserController::class, 'updateRole'])
        ->name('update.role');


    //(show & update group rights)
        Route::middleware(['auth','permission:manage group rights'])
    ->get('/group_rights', [UserController::class,'groupRights'])
    ->name('group_rights');
   
    //update group rights for a role
        Route::post('/group_rights/{role}', [UserController::class, 'updateGroupRights'])
        ->name('group_rights.update');

        });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
