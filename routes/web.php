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

Route::get('/', 'IndexController@index');

Auth::routes();

Route::get('/get-regency/{prov_id}', 'WilayahController@kabupaten');
Route::get('/get-district/{kab_id}', 'WilayahController@kecamatan');
Route::get('/get-village/{kec_id}', 'WilayahController@kelurahan');
Route::get('/get-rayon/{kom_id}', 'WilayahController@rayon');

// Level 1
Route::group([
	'middleware' => 'auth',
	'namespace' => 'Users',	
], function(){
	Route::get('/new-profile', 'NewProfileController@newIndex');
	Route::post('/new-profile/submit', 'NewProfileController@store');	
});

// Level 2
Route::group([
	'middleware' => ['profile', 'auth'],
	'namespace' => 'Users',	
], function(){
	Route::get('/new-kaderisasi', 'KaderisasiController@index');
	Route::post('/kaderisasi/submit', 'KaderisasiController@store');
});

// Level 3
Route::get('/home', 'HomeController@index');
Route::group([
	'middleware' => ['kaderisasi', 'profile', 'auth'],
	'namespace' => 'Users',	
], function(){
	Route::get('/profile', 'ProfileController@index');
	Route::post('/profile/submit', 'ProfileController@store');	
	Route::get('/module', 'ModulController@index');
	Route::post('/module/add', 'ModulController@store');
	Route::get('/module/{file}.{format}', 'PostController@modulSingle');
	Route::get('/video/{file}.{format}', 'PostController@videoSingle');
	Route::get('/video', 'VideoController@index');
	Route::post('/video/add', 'VideoController@store');	
	Route::get('/history', 'HistoryController@index');
	Route::get('/saved', 'WhistlistController@index');
	Route::get('/module/save/{post_id}', 'WhistlistController@addModul');
	Route::get('/module/remove/{post_id}', 'WhistlistController@removeModul');
	Route::get('/video/save/{post_id}', 'WhistlistController@addVideo');
	Route::get('/video/remove/{post_id}', 'WhistlistController@removeVideo');
	Route::get('/data-artikel', 'ArtikelController@getJson');

	Route::get('/get-user-province', 'DataWilayahController@getProvince');
	Route::get('/get-user-city', 'DataWilayahController@getCity');
	Route::get('/get-user-subdistrict', 'DataWilayahController@getSubdistrict');
});

// Test

Route::get('/test', 'TestController@index');
Route::post('/test-cuk', 'TestController@store');

Route::get('/get-provinsi', 'WilayahController@provinsi');
Route::get('/get-kabupaten/{province_id}', 'WilayahController@kabupaten');
Route::get('/get-kecamatan/{city_id}', 'WilayahController@kecamatan');

Route::get('/get-koordinat/{prov}/{city}/{kec}', 'WilayahController@koordinat');

Route::get('auth/google', [App\Http\Controllers\Auth\LoginController::class, 'google']);
Route::get('auth/google/callback', [App\Http\Controllers\Auth\LoginController::class, 'google_callback']);

Route::get('/oursymlink', function () {
	$target = '/home/pmiigali/ehe_pub/storage/app/public';
	$shortcut = '/home/pmiigali/ehe.pmiigalileo.or.id/storage';
	symlink($target, $shortcut);
});
