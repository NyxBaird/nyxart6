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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/blog', 'BlogController@index')->name('blog');
Route::get('/blog/{slug}', 'BlogController@post')->name('blog.post');

Route::get('/about', 'AboutController@index')->name('about');
Route::post('/mailgunDelivery', 'HomeController@catchEmails');

Route::post('/spiritSubmit', 'SpiritController@commandHandle');