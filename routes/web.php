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

Route::get( '/', 'PageController@home' )->name( 'home' );

Route::get( '/lang/{lang}', 'PageController@switchLang' )->name( 'lang.switch' );

Route::get( '/features', 'FeatureController@index' )->name( 'features' );

Route::group( [ 'prefix' => 'book', 'as' => 'book.' ], function () {
	Route::get( '/', 'BookingController@form' )->name( 'form' );
	Route::post( '/', 'BookingController@book' )->name( 'store' );
	Route::get( '/available', 'BookingController@available' )->name( 'available' );
	Route::get( '/{booking}', 'BookingController@info' )->name( 'info' );
} );

Route::group( [ 'prefix' => 'room', 'as' => 'room.' ], function () {
	Route::get( '/', 'RoomController@index' )->name( 'index' );
	Route::get( '/{room_class}', 'RoomController@view' )->name( 'view' );
} );

Route::get( '{page}/{subs?}', [ 'uses' => 'PageController@index' ] )
     ->where( [ 'page' => '^((?!admin).)*$', 'subs' => '.*' ] );
