<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::view('/', 'welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// language routes...
Route::post('/language', 'LanguageController');

Route::post('/password-check', 'PasswordController');

// users routes...
Route::apiResource('users', 'UserController');
Route::get('/deleted/users', 'Trash\DeletedUserController@index');
Route::put('/deleted/users/{user}', 'Trash\DeletedUserController@update');
Route::delete('/deleted/users/{user}', 'Trash\DeletedUserController@destroy');

// organizations routes...
Route::apiResource('organizations', 'OrganizationController');
Route::get('/deleted/organizations', 'Trash\DeletedOrganizationController@index');
Route::put('/deleted/organizations/{organization}', 'Trash\DeletedOrganizationController@update');
Route::delete('/deleted/organizations/{organization}', 'Trash\DeletedOrganizationController@destroy');

// clients routes...
Route::apiResource('clients', 'ClientController');
