<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminRoleController;
use App\Http\Controllers\Admin\AdminPermissionController;
use App\Http\Controllers\MedicalReports\MRController;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authorize;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();
Auth::routes([
    'register' => false,
    'reset' => false,
]);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::prefix('admin')->name('admin.')->group(function(){
Route::group(['middleware' => ['role:super-admin|admin']], function(){
    Route::name('admin.users.')->prefix('users')->group(function() {
        Route::get('/', [AdminUserController::class, 'index'])->name('index');
        Route::post('/', [AdminUserController::class, 'store'])->name('store');
        Route::get('/cr', [AdminUserController::class, 'create'])->name('create');
        Route::get('/{id}/sh', [AdminUserController::class, 'show'])->name('show');
        Route::get('/{id}/ed', [AdminUserController::class, 'edit'])->name('edit');
        Route::post('/{id}/ed', [AdminUserController::class, 'update'])->name('update');
        Route::get('/{id}/cp', [AdminUserController::class, 'changePasswordForm'])->name('change-password-form');
        Route::post('/{id}/cp', [AdminUserController::class, 'changePassword'])->name('change-password');
        Route::get('/{id}/de', [AdminUserController::class, 'destroy'])->name('delete');
    });
    Route::name('admin.roles.')->prefix('roles')->group(function() {
        Route::get('/', [AdminRoleController::class, 'index'])->name('index');
        Route::post('/', [AdminRoleController::class, 'store'])->name('store');
        Route::get('/cr', [AdminRoleController::class, 'create'])->name('create');
        Route::get('/{role}/sh', [AdminRoleController::class, 'show'])->name('show');
        Route::get('/{role}/ed', [AdminRoleController::class, 'edit'])->name('edit');
        Route::post('/{role}/ed', [AdminRoleController::class, 'update'])->name('update');
        Route::get('/{role}/de', [AdminRoleController::class, 'destroy'])->name('delete');
    });
    Route::name('admin.permissions.')->prefix('permissions')->group(function() {
        Route::get('/', [AdminPermissionController::class, 'index'])->name('index');
        Route::post('/', [AdminPermissionController::class, 'store'])->name('store');
        Route::get('/cr', [AdminPermissionController::class, 'create'])->name('create');
        Route::get('/{permission}/sh', [AdminPermissionController::class, 'show'])->name('show');
        Route::get('/{permission}/ed', [AdminPermissionController::class, 'edit'])->name('edit');
        Route::post('/{permission}/ed', [AdminPermissionController::class, 'update'])->name('update');
        Route::get('/{permission}/de', [AdminPermissionController::class, 'destroy'])->name('delete');
    });
});

Route::prefix('medical-reports')->name('medical-reports.')->group(function(){
    Route::get('/', [MRController::class, 'index'])->name('index');
    //
    // alternative way
    //
    // Route::get('/medical_reports', 'App\Http\Controllers\MedicalReports\MRController@index')->name('index');
    //
    Route::post('/', [MRController::class, 'importFile'])->name('import-file');
    Route::get('/{sheets}', [MRController::class, 'readExamsTypes'])->name('read-exams-types');
    Route::get('/report/{report}', [MRController::class, 'showReport'])->name('show-report');
});
// })->middleware(['auth']);