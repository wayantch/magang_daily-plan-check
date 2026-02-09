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
use App\Http\Controllers\ChecklistTemplateController;
use App\Http\Controllers\TypeController;

/*
|--------------------------------------------------------------------------
| GUEST
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login.process');
});

/*
|--------------------------------------------------------------------------
| AUTHENTICATED
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    /*
    |--------------------------------------------------------------------------
    | ADMIN ONLY
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin')->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        // Manage
        Route::resource('users', UserController::class);
        Route::resource('types', TypeController::class);
        Route::resource('categories', CategoryController::class);

        // Master
        Route::resource('areas', AreaController::class);
        Route::resource('rooms', RoomController::class);
        Route::resource('equipments', EquipmentController::class);

        // Checklist Template (ADMIN ONLY)
        // Route::resource('checklist-templates', ChecklistTemplateController::class)
        //     ->except(['show']);
        Route::resource('checklist-templates', ChecklistTemplateController::class);

        // Monitoring hasil checklist
        Route::get('/checklists', [ChecklistController::class, 'adminIndex'])
            ->name('checklists.index');

        Route::get('/checklists/{checklist}', [ChecklistController::class, 'adminShow'])
            ->name('checklists.show');
    });

    /*
    |--------------------------------------------------------------------------
    | OPERATIONS ONLY
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:ops')->group(function () {

        // Home OPS (daftar tugas hari ini)
        Route::get('/ops', [ChecklistController::class, 'opsHome'])
            ->name('ops.home');

        // Isi checklist
        Route::get('/ops/checklists/{template}', [ChecklistController::class, 'create'])
            ->name('ops.checklists.create');

        Route::post('/ops/checklists/{template}', [ChecklistController::class, 'store'])
            ->name('ops.checklists.store');

        // History OPS
        Route::get('/ops/history', [ChecklistController::class, 'myIndex'])
            ->name('ops.checklists.history');
    });
});
