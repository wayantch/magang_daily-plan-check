<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\TypeController;

/*
|--------------------------------------------------------------------------
| AUTH (GUEST)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login.process');

    // register disiapkan tapi bisa dimatikan nanti
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'store'])->name('register.store');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


/*
|--------------------------------------------------------------------------
| AUTHENTICATED USER
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Dashboard (admin & ops, logic beda di controller)
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | ADMIN ONLY
    |--------------------------------------------------------------------------
    */
    // Route::middleware('role:admin')->group(function () {

        // Manage
        Route::resource('users', UserController::class);
        Route::resource('types', TypeController::class);
        Route::resource('categories', CategoryController::class);

        // Master & Monitoring
        Route::resource('areas', AreaController::class);
        Route::resource('rooms', RoomController::class);
        Route::resource('equipments', EquipmentController::class);

        // Checklist monitoring (index & detail admin)
        Route::get('/checklists', [ChecklistController::class, 'index'])
            ->name('checklists.index');

        Route::get('/checklists/{checklist}', [ChecklistController::class, 'show'])
            ->name('checklists.show');
    // });

    /*
    |--------------------------------------------------------------------------
    | OPERATIONS (USER)
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:operations')->group(function () {

        // Form input checklist
        Route::get('/my-checklist/create', [ChecklistController::class, 'create'])
            ->name('my.checklist.create');

        Route::post('/my-checklist', [ChecklistController::class, 'store'])
            ->name('my.checklist.store');

        // History checklist (milik sendiri)
        Route::get('/my-checklist', [ChecklistController::class, 'myIndex'])
            ->name('my.checklist.index');
    });
});
