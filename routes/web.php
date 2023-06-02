<?php

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


Route::group(['prefix' => 'go4more'], function(){
  Voyager::routes();

	Route::get('prizes_report/pdf', 'App\Http\Controllers\DownloadPrizeReport@getPDFReport')->middleware('auth.basic')->name('prizes_report_pdf');
	Route::get('prizes_report/csv', 'App\Http\Controllers\DownloadPrizeReport@getCSVReport')->middleware('auth.basic')->name('prizes_report_csv');
	Route::get('tickets_report/csv', 'App\Http\Controllers\DownloadTicketsReport@getCSVReport')->middleware('auth.basic')->name('tickets_report_csv');
});


Route::get('/', 'App\Http\Controllers\LocaleController@index')->name('home.page')->middleware('landing');
Route::get('/{lang?}', 'App\Http\Controllers\LocaleController@index')->name('home')->middleware('landing');
Route::get('/{lang?}/{view?}', 'App\Http\Controllers\LocaleController@index')->middleware('landing');