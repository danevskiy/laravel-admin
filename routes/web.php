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
Route::get('/companies/{id}', [App\Http\Controllers\CompanyController::class, 'show'])->name('company.show')->middleware('auth');
Route::post('/companies/create', [App\Http\Controllers\CompanyController::class, 'store'])->name('company.store')->middleware('auth');



Route::get('/employees', [App\Http\Controllers\EmployeeController::class, 'index'])->name('employees')->middleware('auth');
