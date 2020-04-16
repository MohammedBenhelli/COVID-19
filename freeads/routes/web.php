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

Route::get('/', function () {
    return view('welcome');
});


//Route::get('/login', 'Auth\LoginController@show')->name('login');
//Route::get('/register', 'Auth\RegisterController@show')->name('register');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@showHome')->name('home');
Route::get('/test', 'HomeController@index')->name('test');
Route::get('/modify', 'HomeController@showModify')->name('modify');
Route::get("/createAds", "AdsController@create")->name("createAds");
Route::post("/sendAds", "AdsController@send")->name("sendAds");
Route::get("/myAds", "AdsController@list")->name("myAds");
Route::get("/deleteAds/{id}", "AdsController@delete")->name("deleteAds");
Route::get("/modifyAds/{id}", "AdsController@modify")->name("modifyAds");
Route::get("/requestAds", "AdsController@modifyRequest")->name("requestAds");


