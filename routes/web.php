<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminRoleController;
use App\Http\Controllers\Admin\AdminPermissionController;
use App\Http\Controllers\MedicalReports\MRController;
use App\Http\Controllers\Dedusting\DedustingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\HomeController;
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
Route::group(['middleware' => ['role_or_permission:admin|visitor']], function(){
  Route::name('admin.')->prefix('admin')->group(function() {
    Route::get('/ap', [HomeController::class, 'adminPanel'])->name('admin-panel');
  });
  Route::name('admin.users.')->prefix('users')->group(function() {
    Route::get('/', [AdminUserController::class, 'index'])->name('index');
    Route::post('/', [AdminUserController::class, 'store'])->name('store');
    Route::get('/cr', [AdminUserController::class, 'create'])->middleware(['can:create users'])->name('create');
    Route::get('/{id}/sh', [AdminUserController::class, 'show'])->middleware(['role_or_permission:visitor|view users'])->name('show');
    Route::get('/{id}/ed', [AdminUserController::class, 'edit'])->middleware(['can:edit users'])->name('edit');
    Route::post('/{id}/ed', [AdminUserController::class, 'update'])->name('update');
    Route::get('/{id}/cp', [AdminUserController::class, 'changePasswordForm'])->middleware(['can:edit users'])->name('change-password-form');
    Route::post('/{id}/cp', [AdminUserController::class, 'changePassword'])->name('change-password');
    Route::get('/{id}/de', [AdminUserController::class, 'destroy'])->middleware(['can:delete users'])->name('delete');
  });
  Route::name('admin.roles.')->prefix('roles')->group(function() {
    Route::get('/', [AdminRoleController::class, 'index'])->name('index');
    Route::post('/', [AdminRoleController::class, 'store'])->name('store');
    Route::get('/cr', [AdminRoleController::class, 'create'])->middleware(['can:create roles'])->name('create');
    Route::get('/{role}/sh', [AdminRoleController::class, 'show'])->middleware(['role_or_permission:visitor|view roles'])->name('show');
    Route::get('/{role}/ed', [AdminRoleController::class, 'edit'])->middleware(['can:edit roles'])->name('edit');
    Route::post('/{role}/ed', [AdminRoleController::class, 'update'])->name('update');
    Route::get('/{role}/de', [AdminRoleController::class, 'destroy'])->middleware(['can:delete roles'])->name('delete');
  });
  Route::name('admin.permissions.')->prefix('permissions')->group(function() {
    Route::get('/', [AdminPermissionController::class, 'index'])->name('index');
    Route::post('/', [AdminPermissionController::class, 'store'])->name('store');
      Route::get('/cr', [AdminPermissionController::class, 'create'])->middleware(['can:create permissions'])->name('create');
    Route::get('/{permission}/sh', [AdminPermissionController::class, 'show'])->middleware(['role_or_permission:visitor|view permissions'])->name('show');
    Route::get('/{permission}/ed', [AdminPermissionController::class, 'edit'])->middleware(['can:edit permissions'])->name('edit');
    Route::post('/{permission}/ed', [AdminPermissionController::class, 'update'])->name('update');
    Route::get('/{permission}/de', [AdminPermissionController::class, 'destroy'])->middleware(['can:delete permissions'])->name('delete');
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

Route::group(['middleware'], function(){
  Route::name('dedusting.')->prefix('dd')->group(function() {
    Route::get('/fa', [DedustingController::class, 'filtrationArea'])->name('filtration-area');
  });
});

Route::prefix('user')->name('user.')->group(function(){
  Route::get('/', [UserController::class, 'show'])->name('show');
  Route::get('/edit', [UserController::class, 'edit'])->name('edit');
  Route::post('/edit', [UserController::class, 'update'])->name('update');
  Route::get('/cp', [UserController::class, 'changePasswordForm'])->name('change-password-form');
  Route::post('/cp', [UserController::class, 'changePassword'])->name('change-password');
});

Route::prefix('visitor')->name('visitor.')->group(function(){
  Route::get('/ap', [VisitorController::class, 'adminPanel'])->name('admin-panel');
});
