<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminRoleController;
use App\Http\Controllers\Admin\AdminPermissionController;
use Illuminate\Http\Request;

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
Route::name('admin.')->group(function(){
    Route::name('roles.')->prefix('roles')->group(function() {
        Route::get('/', [AdminRoleController::class, 'index'])->name('index');
        Route::post('/', [AdminRoleController::class, 'store'])->name('store');
        Route::get('/cr', [AdminRoleController::class, 'create'])->name('create');
        Route::get('/{role}/st', [AdminRoleController::class, 'show'])->name('show');
        Route::get('/{role}/ed', [AdminRoleController::class, 'edit'])->name('edit');
        Route::post('/{role}/ed', [AdminRoleController::class, 'update'])->name('update');
        Route::get('/{role}/de', [AdminRoleController::class, 'destroy'])->name('delete');
    });
    Route::name('permissions.')->prefix('permissions')->group(function() {
        Route::get('/', [AdminPermissionController::class, 'index'])->name('index');
        Route::post('/', [AdminPermissionController::class, 'store'])->name('store');
        Route::get('/cr', [AdminPermissionController::class, 'create'])->name('create');
        Route::get('/{permission}/st', [AdminPermissionController::class, 'show'])->name('show');
        Route::get('/{permission}/ed', [AdminPermissionController::class, 'edit'])->name('edit');
        Route::post('/{permission}/ed', [AdminPermissionController::class, 'update'])->name('update');
        Route::get('/{permission}/de', [AdminPermissionController::class, 'destroy'])->name('delete');
    });
});

Route::prefix('medical-report')->group(function(){
    Route::get('/', [MRController::class, 'index'])->name('index');
    //
    // alternative way
    //
    // Route::get('/medical_reports', 'App\Http\Controllers\MedicalReports\MRController@index')->name('index');
    //
    Route::post('/', [MRController::class, 'importFile'])->name('import-file');
    Route::get('/{sheets}', [MRController::class, 'readExamsTypes'])->name('read-exams-types');
    Route::get('/report/{report}', [MRController::class, 'showReport'])->name('show-report');
// });
})->middleware(['auth'])->name('medical-reports.');