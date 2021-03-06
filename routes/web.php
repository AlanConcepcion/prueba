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

Route::get('/', 'JobController@index')->name('job.index');

//Route::get('/job/', 'JobController@list');
//Route::get('/job/{company}/{location}/{id}/{position}', 'JobController@show')->name('job.show');
//Route::get('/job/{id}/edit', 'JobController@edit')->name('job.edit');

Route::get('/category/{id}/{slug}', 'CategoryController@show')->name('category.show');

Route::resource('job','JobController');
Route::get('/job/{id}/{company}/{location}/{position}', 'JobController@show')->name('job.show');
Route::get('/search/', 'JobController@search');
Route::get('/job/', 'JobController@list');
Route::get('/job/{token}/{company}/{location}/{position}', 'JobController@preview')->name('job.preview');
Route::post('/job/{token}/publish/', 'JobController@publish')->name('job.publish');
Route::post('/job/{token}/extend/', 'JobController@extend')->name('job.extend');
Route::get('/delete/{id}', 'CategoryController@deleteCategory');
Route::get('/delete/{id}', 'JobController@deleteJob');
Route::get('/getColumnNames/', 'JobController@getColumnNames');
Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
