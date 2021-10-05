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

Route::get('/home', 'HomeController@index');

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
	Route::get('/new-profile', 'ProfileController@newIndex');
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
Route::group([
	'middleware' => ['kaderisasi', 'profile', 'auth'],
	'namespace' => 'Users',	
], function(){
	Route::get('/profile', 'ProfileController@index');
	Route::resource('/modul', 'ModulController');
	Route::get('/modul/files/{post}.{format}', 'PDFViewerController@index');
	Route::post('/profile/submit', 'ProfileController@store');	
});

// Test

Route::get('/test', 'TestController@index');
Route::post('/test-cuk', 'TestController@store');

Route::get('auth/google', [App\Http\Controllers\Auth\LoginController::class, 'google']);
Route::get('auth/google/callback', [App\Http\Controllers\Auth\LoginController::class, 'google_callback']);

Route::get('/oursymlink', function () {
	$target = '/home/pmiigali/ehe_pub/storage/app/public';
	$shortcut = '/home/pmiigali/ehe.pmiigalileo.or.id/storage';
	symlink($target, $shortcut);
});