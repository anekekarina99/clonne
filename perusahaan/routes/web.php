<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('companies', CompanyController::class);
Route::resource('employees', EmployeeController::class);
Route::get('companies/{company}/export-pdf', [EmployeeController::class, 'exportPdf'])->name('companies.exportPdf');
Route::post('employees/import', [EmployeeController::class, 'import'])->name('employees.import');
Route::get('companies/select2', [CompanyController::class, 'select2'])->name('companies.select2');
