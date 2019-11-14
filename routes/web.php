<?php

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

//Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', 'companyController@index')->name('home');
    Route::get('/home/add', 'companyController@create')->name('createCompany');
    Route::get('/home/edit/{id}', 'companyController@edit')->name('editCompany');
    Route::post('/home', 'companyController@store')->name('storeCompany');
    Route::put('/home/update/{id}', 'companyController@update')->name('updateCompany');
    Route::get('/home/{id}', 'companyController@destroy')->name('destroyCompany');

    Route::get('/company/{id}', 'employeeController@show')->name('listEmployee');
    Route::get('/employee/add/{id}', 'employeeController@create')->name('createEmployee');
    Route::get('/employee/edit/{id}', 'employeeController@edit')->name('editEmployee');
    Route::post('/employee', 'employeeController@store')->name('storeEmployee');
    Route::put('/employee/update/{id}', 'employeeController@update')->name('updateEmployee');
    Route::get('/employee/{id}', 'employeeController@destroy')->name('destroyEmployee');
});
