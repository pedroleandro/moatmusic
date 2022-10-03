<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/user/{user}/roles', [\App\Http\Controllers\UserController::class, 'roles'])->name('user.roles');
Route::put('/user/{user}/roles/sync', [\App\Http\Controllers\UserController::class, 'sync'])->name('user.roles.sync');
Route::resource('user', \App\Http\Controllers\UserController::class);

Route::get('/role/{role}/permissions', [\App\Http\Controllers\RoleController::class, 'permissions'])->name('role.permissions');
Route::put('/role/{role}/permissions/sync', [\App\Http\Controllers\RoleController::class, 'sync'])->name('role.permissions.sync');
Route::resource('role', \App\Http\Controllers\RoleController::class);

Route::resource('permission', \App\Http\Controllers\PermissionController::class);
