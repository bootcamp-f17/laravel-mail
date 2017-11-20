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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/messages/starred', 'MessageController@starred');

Route::get('/messages/trash', 'MessageController@trash');

Route::get('/messages/sent', 'MessageController@sent');

Route::get('/messages/drafts', 'MessageController@drafts');

Route::post('/messages/{id}/star', 'MessageController@star');

Route::post('/messages/{id}/unread', 'MessageController@unread');

Route::post('/messages/{id}/starInbox', 'MessageController@starInbox');

Route::resource('/messages', 'MessageController');

