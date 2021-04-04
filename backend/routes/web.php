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

Route::get('/', 'GoalController@index')->name('goals.index');

Auth::routes();

Route::resource('/goals', 'GoalController')->except(['index, show'])->middleware('auth');
Route::resource('/goals', 'GoalController')->only(['show']);
