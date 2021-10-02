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
	
});

Route::group([
	'namespace' => 'Users'
], function(){
	Route::get('/profile', 'ProfileController@index');
	Route::resource('/modul', 'ModulController');
});

Route::group([
	'middleware' => ['auth'],
	'prefix' => 'filemanager'
], function() {
	\UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::get('/test', 'TestController@index');	

Route::get('auth/google', [App\Http\Controllers\Auth\LoginController::class, 'google']);
Route::get('auth/google/callback', [App\Http\Controllers\Auth\LoginController::class, 'google_callback']);