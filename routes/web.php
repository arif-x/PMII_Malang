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

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::post('/profile', 'ProfileController@submit');
Route::get('/get-regency/{prov_id}', 'WilayahController@kabupaten');
Route::get('/get-district/{kab_id}', 'WilayahController@kecamatan');
Route::get('/get-village/{kec_id}', 'WilayahController@kelurahan');
Route::get('/get-rayon/{kom_id}', 'WilayahController@rayon');

Route::group([
	'middleware' => ['verified', 'auth']
], function(){
	Route::get('/profile', 'ProfileController@index');	
});

Route::get('/test', 'TestController@index');	
