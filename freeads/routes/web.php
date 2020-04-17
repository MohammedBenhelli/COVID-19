<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@showHome')->name('home');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@showHome')->name('home');
Route::get('/test', 'HomeController@index')->name('test');
Route::get('/modify', 'HomeController@showModify')->name('modify');
Route::get("/modifyUser", "HomeController@modify")->name("modifyUser");
Route::get("/createAds", "AdsController@create")->name("createAds");
Route::post("/sendAds", "AdsController@send")->name("sendAds");
Route::get("/searchAds", "AdsController@search")->name("searchAds");
Route::get("/myAds", "AdsController@list")->name("myAds");
Route::get("/deleteAds/{id}", "AdsController@delete")->name("deleteAds");
Route::get("/modifyAds/{id}", "AdsController@modify")->name("modifyAds");
Route::get("/requestAds", "AdsController@modifyRequest")->name("requestAds");
Route::get("/messagesCount", "MessagesController@getCount")->name("getCount");

Route::group(['prefix' => 'messages'], function () {
    Route::get('/', ['as' => 'messages', 'uses' => 'MessagesController@index']);
    Route::get('/unread', ['as' => 'messages.unread', 'uses' => 'MessagesController@unread']);
    Route::get('/create/{id}', ['as' => 'messages.create', 'uses' => 'MessagesController@create']);
    Route::post('/', ['as' => 'messages.store', 'uses' => 'MessagesController@store']);
    Route::get('{id}', ['as' => 'messages.show', 'uses' => 'MessagesController@show']);
    Route::put('{id}', ['as' => 'messages.update', 'uses' => 'MessagesController@update']);
    Route::get('{id}/read', ['as' => 'messages.read', 'uses' => 'MessagesController@read']);
});

