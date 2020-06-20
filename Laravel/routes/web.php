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

Route::get('/', 'TaskController@index')->name('home');
Route::get('/add-task', 'TaskController@add')->name('add-task');
Route::post('/process-add-task', 'TaskController@processAdd')->name('process-add-task');