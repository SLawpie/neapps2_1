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
    Route::get('/roles', [AdminRoleController::class, 'index'])->name('roles.index');
    Route::get('/permissions', [AdminPermissionController::class, 'index'])->name('permissions.index');
    Route::post('/permissions', [AdminPermissionController::class, 'store'])->name('permission.store');
    Route::get('/permissions/create', [AdminPermissionController::class, 'create'])->name('permission.create');
    Route::get('/permissions/{permission}/delete', [AdminPermissionController::class, 'destroy'])->name('permission.delete');
    Route::get('/permissions/{permission}/show', [AdminPermissionController::class, 'show'])->name('permission.show');
    Route::get('/permissions/{permission}/edit', [AdminPermissionController::class, 'edit'])->name('permission.edit');
    Route::post('/permissions/{permission}/edit', [AdminPermissionController::class, 'update'])->name('permission.update');
    
    Route::get('/{role}', [AdminPermissionController::class, 'destroy'])->name('role.delete');
});