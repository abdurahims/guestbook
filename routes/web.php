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
    return redirect('/messages');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin/register', 'Auth\RegisterController@showAdminRegistrationForm')->name('adminregister');
Route::post('/register/admin', 'Auth\RegisterController@registeradmin')->name('registeradmin');

Route::resource('messages', 'MessagesController');
Route::get('ownmessages', 'MessagesController@ownmessages')->name('ownmessages');
Route::get('messages/{id}/reply', 'MessagesController@reply')->name('messages.reply');
