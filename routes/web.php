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
	Route::get('/module/{file}', 'PostController@modulSingle');
	Route::get('/video/{file}', 'PostController@videoSingle');
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
], function(){
	Route::get('/admin-komisariat/dashboard', 'HomeController@komIndex');
});

Route::group([
	'middleware' => ['komisariat', 'auth'],
	'namespace' => 'AdminKomisariat'
], function(){
	Route::resource('/admin-komisariat/rayon', 'RayonController');
	Route::get('/admin-komisariat', function(){
		return redirect('/admin-komisariat/dashboard');
	});
	Route::group([
		'namespace' => 'Kader'
	], function(){
		Route::resource('/admin-komisariat/kader', 'AllController');		
		Route::resource('/admin-komisariat/kader/filter', 'FilterController');
		Route::get('/admin-komisariat/kader/detail/{id}', 'DetailController@index');
	});
	Route::group([
		'namespace' => 'Postingan'
	], function(){
		Route::resource('/admin-komisariat/postingan', 'AllController');
		Route::resource('/admin-komisariat/postingan/filter', 'FilterController');
		Route::get('/admin-komisariat/postingan/detail/{id}', 'DetailController@index');
	});
	Route::group([
		'namespace' => 'Export'
	], function(){
		Route::get('/admin-komisariat/export/kader', 'KaderController@export');
		Route::get('/admin-komisariat/export/post', 'PostController@export');
		Route::get('/admin-komisariat/export/rayon', 'RayonController@export');
	});
});

// =========================================== Admin Rayon Section ===========================================
Route::group([
	'middleware' => ['rayon', 'auth'],
], function(){
	Route::get('/admin-rayon/dashboard', 'HomeController@rayonIndex');
});

Route::group([
	'middleware' => ['rayon', 'auth'],
	'namespace' => 'AdminRayon'
], function(){
	Route::get('/admin-rayon', function(){
		return redirect('/admin-rayon/dashboard');
	});
	Route::group([
		'namespace' => 'Kader'
	], function(){
		Route::resource('/admin-rayon/kader', 'AllController');		
		Route::resource('/admin-rayon/kader/filter', 'FilterController');
		Route::get('/admin-rayon/kader/detail/{id}', 'DetailController@index');
	});
	Route::group([
		'namespace' => 'Postingan'
	], function(){
		Route::resource('/admin-rayon/postingan', 'AllController');
		Route::resource('/admin-rayon/postingan/filter', 'FilterController');
		Route::get('/admin-rayon/postingan/detail/{id}', 'DetailController@index');
	});
	Route::group([
		'namespace' => 'Export'
	], function(){
		Route::get('/admin-rayon/export/kader', 'KaderController@export');
		Route::get('/admin-rayon/export/post', 'PostController@export');
	});
});

// ============================================ Super Admin Section ============================================
Route::group([
	'middleware' => ['admin', 'auth'],
], function(){
	Route::get('/admin/dashboard', 'HomeController@adminIndex');
});

Route::group([
	'middleware' => ['admin', 'auth'],
	'namespace' => 'Admin'
], function(){
	Route::get('/admin', function(){
		return redirect('/admin/dashboard');
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
		Route::resource('/admin/kader', 'AllController');		
		Route::resource('/admin/filter-kader', 'FilterController');
		Route::get('/admin/kader/detail/{id}', 'DetailController@index');
	});
	Route::group([
		'namespace' => 'Postingan'
	], function(){
		Route::resource('/admin/postingan', 'AllController');
		Route::resource('/admin/filter-postingan', 'FilterController');
		Route::get('/admin/postingan/detail/{id}', 'DetailController@index');
	});
	Route::group([
		'namespace' => 'Export'
	], function(){
		Route::get('/admin/export/kader', 'KaderController@export');
		Route::get('/admin/export/post', 'PostController@export');
		Route::get('/admin/export/komisariat', 'KomisariatController@export');
		Route::get('/admin/export/pekerjaan', 'PekerjaanController@export');
		Route::get('/admin/export/pendidikan', 'PendidikanController@export');
		Route::get('/admin/export/rayon', 'RayonController@export');
	});
});

// Test
// Route::get('/test', 'TestController@index');
// Route::post('/test-cuk', 'TestController@store');
// Route::get('/get-koordinat/{prov}/{city}/{kec}', 'WilayahController@koordinat');

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

Route::group([
	'middleware' => ['auth'],
], function(){
	Route::get('/storage/foto/{filename}', function($filename){
		$path = storage_path() . '/app/public/foto/' . $filename;
		// echo $path;
		if(!File::exists($path)) abort(404);

		$file = File::get($path);
		$type = File::mimeType($path);

		$response = Response::make($file, 200);
		$response->header('Content-Type', $type);

		return $response;	
	});
});