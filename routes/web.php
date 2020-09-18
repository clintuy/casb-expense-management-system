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

Route::group(['middleware' => 'auth'], function() {

    Route::get('/dashboard', 'HomeController@index')->name('dashboard');
    Route::resource('users', 'UsersController');
    Route::resource('roles', 'RolesController');
    Route::resource('permissions', 'PermissionsController');

    Route::resource('expense-categories', 'ExpenseCategoriesController');
    Route::resource('expenses', 'ExpensesController');
});

Route::get('/', function () {
    return Redirect::to( '/login');
});
Route::get('/register', function () {
    return Redirect::to( '/login');
});
Route::get('/reset', function () {
    return Redirect::to( '/login');
});
Route::get('/verify', function () {
    return Redirect::to( '/login');
});

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false
]);