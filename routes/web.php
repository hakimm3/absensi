<?php

use App\Http\Controllers\Admin\Attendance\ExportAttendanceController;
use App\Http\Controllers\Admin\Attendance\ImportAttendanceController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Auth::routes();

Route::middleware('auth')->group(function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    Route::prefix('profile')->as('profile.')->group(function () {
        Route::get('edit', [App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('edit');
        Route::put('update', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('update');
        Route::put('update-password', [App\Http\Controllers\Admin\ProfileController::class, 'updatePassword'])->name('update-password');
        Route::post('update-photo', [App\Http\Controllers\Admin\ProfileController::class, 'updatePhoto'])->name('update-photo');
    });

    Route::prefix('user-management')->as('user-management.')->group(function(){
        Route::resource('department', App\Http\Controllers\Admin\UserManagement\DepartmentController::class)->except('show', 'update', 'create');
        Route::resource('users',  App\Http\Controllers\Admin\UserManagement\UserController::class)->except('show', 'update', 'create');
    });

    Route::prefix('authorization')->as('authorization.')->group(function(){
        Route::resource('role', App\Http\Controllers\Admin\Authorization\RoleController::class)->except('update', 'create');
        Route::post('role-permission/{id}', App\Http\Controllers\Admin\Authorization\RolePermissionController::class)->name('role-permission');
        Route::resource('permission', App\Http\Controllers\Admin\Authorization\PermissionController::class)->except('show', 'update', 'create');
    });

    Route::prefix('employee')->as('employee.')->group(function(){
        Route::resource('attendance', App\Http\Controllers\Admin\Attendance\AttendanceController::class)->except('show', 'update', 'create');
        Route::post('attendance/import', ImportAttendanceController::class)->name('attendance.import');
        Route::get('attendance/export', ExportAttendanceController::class)->name('attendance.export');

        Route::resource('minus-poin', App\Http\Controllers\Admin\Employee\MinusPoinController::class)->except('show', 'update', 'create');
    });


    Route::prefix('setting')->as('setting.')->group(function(){
        Route::resource('mipo', App\Http\Controllers\Admin\Setting\MipoSettingControlller::class)->except('show', 'update', 'create');
    });
});



