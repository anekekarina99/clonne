<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;

Route::resource('companies', CompanyController::class);
Route::resource('employees', EmployeeController::class);

