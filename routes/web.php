<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\SignupController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\GetIDCode;
use App\Http\Controllers\UsersTimeController;

Route::get('/', [SignupController::class, 'index'])->name('signup');
Route::post('/', [SignupController::class, 'insert']);
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'attempt']);
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::get('/home', [ProfileController::class, 'index']);
Route::get('/admin', [AdminController::class, 'index'])->name('admin'); //? to admin
Route::get('/manager', [ProfileController::class, 'index'])->name('manager'); //? to manager
Route::get('/employee', [EmployeeController::class, 'index'])->name('employee'); //? to employee
Route::get('/user', [UsersController::class, 'index'])->name('users');
Route::get('/user-time', [UsersTimeController::class, 'index'])->name('users_time');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

//? for users
Route::get('/users', [UsersController::class, 'select_users']); //? retrieve users data
Route::get('/users-emp', [EmployeeController::class, 'select_users_emp']); //? retrieve users emp data
Route::get('/users-emp-time', [UsersTimeController::class, 'select_users_emp_time']); //? retrieve users emp data
Route::get('/id-code', [GetIDCode::class, 'id_code']); //? retrieve id code
Route::post('/insert-user', [UsersController::class, 'create_user']); //? create user
Route::post('/update-user', [UsersController::class, 'update_user']); //? update user
Route::post('/update-description', [ProfileController::class, 'update_description']); //? update description
Route::get('/search-user', [UsersController::class, 'search_user']); //? search user
Route::post('/delete-user', [UsersController::class, 'delete_user']); //? delete user