<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Second;

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

Auth::routes(['register' => false]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/companies', [App\Http\Controllers\CompanyController::class, 'index'])->name('companies')->middleware('auth');
Route::get('/companies/create', [App\Http\Controllers\CompanyController::class, 'create'])->name('company.create')->middleware('auth');
Route::get('/companies/{id}', [App\Http\Controllers\CompanyController::class, 'edit'])->name('company.edit')->middleware('auth');
Route::post('/companies/create', [App\Http\Controllers\CompanyController::class, 'store'])->name('company.store')->middleware('auth');
Route::put('/companies/update/{id}', [App\Http\Controllers\CompanyController::class, 'update'])->name('company.update')->middleware('auth');
Route::delete('/companies/delete/{id}', [App\Http\Controllers\CompanyController::class, 'destroy'])->name('company.destroy')->middleware('auth');



Route::get('/employees', [App\Http\Controllers\EmployeeController::class, 'index'])->name('employees')->middleware('auth');
Route::get('/employees/create', [App\Http\Controllers\EmployeeController::class, 'create'])->name('employee.create')->middleware('auth');
Route::get('/employees/{id}', [App\Http\Controllers\EmployeeController::class, 'edit'])->name('employee.edit')->middleware('auth');
Route::post('/employees/create', [App\Http\Controllers\EmployeeController::class, 'store'])->name('employee.store')->middleware('auth');
Route::put('/employees/update/{id}', [App\Http\Controllers\EmployeeController::class, 'update'])->name('employee.update')->middleware('auth');
Route::delete('/employees/delete/{id}', [App\Http\Controllers\EmployeeController::class, 'destroy'])->name('employee.destroy')->middleware('auth');
