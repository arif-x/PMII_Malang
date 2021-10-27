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

// Authentication
Auth::routes();
Route::get('auth/google', [App\Http\Controllers\Auth\LoginController::class, 'google']);
Route::get('auth/google/callback', [App\Http\Controllers\Auth\LoginController::class, 'google_callback']);


// =============================================== User Section ===============================================
// Auth 1 => User Baru
Route::group([
	'middleware' => 'auth',
	'namespace' => 'Users',	
], function(){
	Route::get('/new-profile', 'NewProfileController@newIndex');
	Route::post('/new-profile/submit', 'NewProfileController@store');	
});

// Auth 2 => Telah Mengisi Profile
Route::group([
	'middleware' => ['profile', 'auth'],
	'namespace' => 'Users',	
], function(){
	Route::get('/new-kaderisasi', 'KaderisasiController@index');
	Route::post('/kaderisasi/submit', 'KaderisasiController@store');
});

// Auth 2 => Telah Mengisi Profile & Kaderisasi
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
});

// ========================================= Admin Komisariat Section =========================================
Route::group([
	'middleware' => ['komisariat', 'auth'],
	'namespace' => 'AdminKomisariat'
], function(){
	Route::resource('/admin-komisariat/rayon', 'RayonController');
	Route::get('/admin-komisariat', function(){
		return redirect('/admin-komisariat/kader');
	});
	Route::get('/admin-komisariat/kader', function(){
		return redirect('/admin-komisariat/kader/all');
	});
	Route::group([
		'namespace' => 'Kader'
	], function(){
		Route::resource('/admin-komisariat/kader/all', 'AllController');		
		Route::resource('/admin-komisariat/kader/filter', 'FilterController');
		Route::get('/admin-komisariat/kader/detail/{id}', 'DetailController@index');
	});
	Route::group([
		'namespace' => 'Postingan'
	], function(){
		Route::resource('/admin-komisariat/postingan/all', 'AllController');
		Route::resource('/admin-komisariat/postingan/filter', 'FilterController');
		Route::get('/admin-komisariat/postingan/detail/{id}', 'DetailController@index');
	});
});

// ========================================= Admin Komisariat Section =========================================
Route::group([
	'middleware' => ['rayon', 'auth'],
	'namespace' => 'AdminRayon'
], function(){
	Route::get('/admin-rayon', function(){
		return redirect('/admin-rayon/kader');
	});
	Route::get('/admin-rayon/kader', function(){
		return redirect('/admin-rayon/kader/all');
	});
	Route::group([
		'namespace' => 'Kader'
	], function(){
		Route::resource('/admin-rayon/kader/all', 'AllController');		
		Route::resource('/admin-rayon/kader/filter', 'FilterController');
		Route::get('/admin-rayon/kader/detail/{id}', 'DetailController@index');
	});
	Route::group([
		'namespace' => 'Postingan'
	], function(){
		Route::resource('/admin-rayon/postingan/all', 'AllController');
		Route::resource('/admin-rayon/postingan/filter', 'FilterController');
		Route::get('/admin-rayon/postingan/detail/{id}', 'DetailController@index');
	});
});

// ============================================ Super Admin Section ============================================
Route::group([
	'middleware' => ['admin', 'auth'],
	'namespace' => 'Admin'
], function(){
	Route::get('/admin', function(){
		return redirect('/admin/kader');
	});
	Route::get('/admin/kader', function(){
		return redirect('/admin/kader/all');
	});
	Route::resource('/admin/slider', 'SliderController');
	Route::resource('/admin/menu', 'MenuController');
	Route::resource('/admin/komisariat', 'KomisariatController');
	Route::resource('/admin/pekerjaan', 'PekerjaanController');
	Route::resource('/admin/pendidikan', 'PendidikanController');
	Route::resource('/admin/rayon', 'RayonController');
	Route::get('/admin/get-kom/{id}', 'RayonController@getKom');
	Route::group([
		'namespace' => 'Kader'
	], function(){
		Route::resource('/admin/kader/all', 'AllController');		
		Route::resource('/admin/kader/filter', 'FilterController');
		Route::get('/admin/kader/detail/{id}', 'DetailController@index');
	});
	Route::group([
		'namespace' => 'Postingan'
	], function(){
		Route::resource('/admin/postingan/all', 'AllController');
		Route::resource('/admin/postingan/filter', 'FilterController');
		Route::get('/admin/postingan/detail/{id}', 'DetailController@index');
	});
	Route::group([
		'namespace' => 'Export'
	], function(){
		Route::get('/admin/kader/export-kader', 'KaderController@export');
	});
});

// Test
Route::get('/test', 'TestController@index');
Route::post('/test-cuk', 'TestController@store');
Route::get('/get-koordinat/{prov}/{city}/{kec}', 'WilayahController@koordinat');

// Data Wilayah
Route::get('/get-provinsi', 'WilayahController@provinsi');
Route::get('/get-kabupaten/{province_id}', 'WilayahController@kabupaten');
Route::get('/get-kecamatan/{city_id}', 'WilayahController@kecamatan');
Route::get('/get-rayon/{kom_id}', 'WilayahController@rayon');

// Comment After Create Symlink in Hosting
// Symlink digunakan sebagai sinkronasi directory storage ke public
Route::get('/oursymlink', function () {
	$target = '/home/pmiigali/ehe_pub/storage/app/public';
	$shortcut = '/home/pmiigali/ehe.pmiigalileo.or.id/storage';
	symlink($target, $shortcut);
});