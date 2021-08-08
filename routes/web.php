<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\CheckUsers;

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
    if (!Auth::check()) {
        return view('auth.login');
    }else{
        return view('home');
    }
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//companies
Route::middleware([CheckUsers::class])->group(function(){
    Route::get('/companies', 'CompaniesController@index')->name('companies')->middleware('auth'); 
    Route::post('/companies/get-by-id', 'CompaniesController@getById')->name('companies_getbyid')->middleware('auth'); 
    Route::post('/companies/edit', 'CompaniesController@edit')->name('company_edit')->middleware('auth'); 
    Route::post('/companies/create', 'CompaniesController@create')->name('company_create')->middleware('auth'); 
    Route::post('/companies/delete', 'CompaniesController@delete')->name('company_delete')->middleware('auth'); 
    //employees
    Route::get('/employees', 'EmployeesController@index')->name('employees')->middleware('auth');
    Route::post('/employees/get-by-id', 'EmployeesController@getById')->name('employees_getbyid')->middleware('auth'); 
    Route::post('/employees/edit', 'EmployeesController@edit')->name('employee_edit')->middleware('auth'); 
    Route::post('/employees/create', 'EmployeesController@create')->name('employee_create')->middleware('auth'); 
    Route::post('/employees/delete', 'EmployeesController@delete')->name('employee_delete')->middleware('auth'); 
   
});