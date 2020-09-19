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

    // Dashboard Route
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    // Profile Route
    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::post('/profile/change-password', 'ProfileController@change_password')->name('change_password');

    // Users Route
    Route::resource('users', 'UsersController');

    // Roles Route
    Route::resource('roles', 'RolesController');

    // Permissions Route
    Route::resource('permissions', 'PermissionsController');

    // Expense Categories Route
    Route::resource('expense-categories', 'ExpenseCategoriesController');

    // Expenses Route
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