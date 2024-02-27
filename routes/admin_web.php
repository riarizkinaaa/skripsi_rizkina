<?php

use App\Http\Controllers\Admin\AnakController as AdminAnakController;
use App\Http\Controllers\AnakController;
use App\Http\Controllers\RoleController;
// use App\Http\Controllers\Admin\UserlogController;
// use App\Http\Controllers\KelasPendidikanController;
// use App\Http\Controllers\PendidikanController;
// use App\Http\Controllers\PekerjaanController;
// use App\Http\Controllers\PrestasiFormalController;
// use App\Http\Controllers\PrestasiNonFormalController;
// use App\Http\Controllers\KecamtanController;
// use App\Http\Controllers\DesaController;
use App\Http\Controllers\Admin\DusunController;
use App\Http\Controllers\SurviorController;
use App\Http\Controllers\VerifikatorController;
use App\Http\Controllers\PimpinanController;
use App\Http\Controllers\Koordinator\KoordinatorController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;



// Awal Route Hak Akses Survior
Route::prefix('survior')->middleware('auth', 'cek_login:4')->group(function () {
	//dashboard
	Route::get('dashboard_survior', [\App\Http\Controllers\Survior\SurviorController::class, 'dashboard'])->name('dashboard_survior');

	Route::resource('anak_pendata', \App\Http\Controllers\Survior\AnakController::class);
	Route::resource('formal', \App\Http\Controllers\Survior\PrestasiFormalController::class);
	Route::resource('nonformal', \App\Http\Controllers\Survior\PrestasinonFormalController::class);
	Route::resource('data_survior', \App\Http\Controllers\Survior\SurviorController::class);

	Route::post('ubah_pass/{id}', [\App\Http\Controllers\Survior\SurviorController::class, 'ubah_pass'])->name('pass_ubah');

	// detail anak
	Route::get('detail/{id}', [\App\Http\Controllers\Survior\AnakController::class, 'detail'])->name('detail');

	// upload Gambar
	Route::post('upload_gambar', [\App\Http\Controllers\Survior\AnakController::class, 'upload_gambar'])->name('upload_gambar');

	// import anak
	Route::post('import_anak', [\App\Http\Controllers\Survior\AnakController::class, 'import_anak']);
	Route::get('view_anak', [\App\Http\Controllers\Survior\AnakController::class, 'view_import']);

	// Export Anak
	Route::get('export_anak', [\App\Http\Controllers\Survior\AnakController::class, 'export_anak']);

	// data json
	Route::get('json_anak', [\App\Http\Controllers\Admin\AnakController::class, 'all_anak']);
	Route::get('getdesa_json', [\App\Http\Controllers\Admin\DusunController::class, 'getdesa']);

	//kontak
	Route::get('kontak', [\App\Http\Controllers\Survior\SurviorController::class, 'kontak'])->name('kontak');

	// download Format data
	Route::get('download', [\App\Http\Controllers\Survior\AnakController::class, 'getDownload'])->name('download');
});
// Akhir Route Hak Akses Survior

// Awal Route Hak Akses Koordinator
Route::prefix('koordinator')->middleware('auth', 'cek_login:5')->group(function () {
	
	// Route::resource('dashboard_koordinator', KoordinatorController::class)->names('dashboard_koordinator');
	Route::resource('data_koordinator', KoordinatorController::class)->names('data_koordinator');
	Route::resource('anak_koordinator', \App\Http\Controllers\Koordinator\AnakController::class);
	// detail anak
	Route::get('detail-anak/{id}', [\App\Http\Controllers\Koordinator\AnakController::class, 'detail_anak']);

	// verifikasi anak
	Route::get('verifi-anak/{id}', [\App\Http\Controllers\Koordinator\AnakController::class, 'verifi_anak'])->name('verifi-anak');
	//sudah verifikasi anak
	Route::get('sdh-verifikasi', [\App\Http\Controllers\Koordinator\AnakController::class, 'sdh_verifikasi'])->name('sdh-verifikasi');

	// Export verifikasi anak
	Route::get('export-verifikasi-anak', [\App\Http\Controllers\Koordinator\AnakController::class, 'export_verifikasi_anak'])->name('export-verifikasi-anak');

	// Export verifikasi sudah anak
	Route::get('export-verifikasi-sudah-anak', [\App\Http\Controllers\Koordinator\AnakController::class, 'export_verifikasi_sudah_anak'])->name('export-verifikasi-sudah-anak');

	// data json
	Route::get('json_all_anak_koor', [\App\Http\Controllers\Admin\AnakController::class, 'all_anak']);
});
// Akhir Route Hak Akses Koordinator

// Awal Route Hak Akses Verifikator
Route::prefix('verifikator')->middleware('auth', 'cek_login:3')->group(function () {
	Route::resource('data_verifikator', \App\Http\Controllers\Verifikator\VerifikatorController::class);
	Route::resource('anak_verifikator', \App\Http\Controllers\Verifikator\AnakController::class);

	// detail anak
	Route::get('detail-anak/{id}', [\App\Http\Controllers\Verifikator\AnakController::class, 'detail_anak']);

	// verifikasi anak
	Route::get('verifikasi-anak/{id}', [\App\Http\Controllers\Verifikator\AnakController::class, 'verifikasi_anak'])->name('verifikasi-anak');
	//sudah verifikasi anak
	Route::get('sudah-verifikasi', [\App\Http\Controllers\Verifikator\AnakController::class, 'sudah_verifikasi'])->name('sudah-verifikasi');

	// Export verifikasi anak
	Route::get('export-verifikasi-anak', [\App\Http\Controllers\Verifikator\AnakController::class, 'export_verifikasi_anak'])->name('export-verifikasi-anak');

	// Export verifikasi sudah anak
	Route::get('export-verifikasi-sudah-anak', [\App\Http\Controllers\Verifikator\AnakController::class, 'export_verifikasi_sudah_anak'])->name('export-verifikasi-sudah-anak');

	// data json
	Route::get('json_all_anak', [\App\Http\Controllers\Admin\AnakController::class, 'all_anak']);
});
// Akhir Route Hak Akses Verifikator

// Awal Route Hak akses Pimpinan
Route::prefix('pimpinan')->middleware('auth', 'cek_login:2')->group(function () {
	Route::resource('pimpinan', \App\Http\Controllers\Pimpinan\PimpinanController::class);
	Route::resource('data-anak', \App\Http\Controllers\Pimpinan\AnakController::class);

	// Export Anak
	Route::get('export_anaks', [\App\Http\Controllers\Pimpinan\AnakController::class, 'export_anak']);
	Route::get('export_anak_belumver', [\App\Http\Controllers\Pimpinan\AnakController::class, 'export_anak_belum']);
	Route::get('export_anak_sudahver', [\App\Http\Controllers\Pimpinan\AnakController::class, 'export_anak_sudah']);

	// belum_verifikasi
	Route::get('belum_verifikasi', [\App\Http\Controllers\Pimpinan\AnakController::class, 'belum_verifikasi'])->name('belum_verifikasi');
	// sudah_verifikasi
	Route::get('sudah_verifikasi', [\App\Http\Controllers\Pimpinan\AnakController::class, 'sudah_verifikasi'])->name('sudah_verifikasi');

	// data json
	Route::get('json_all_anaks', [\App\Http\Controllers\Admin\AnakController::class, 'all_anak']);
});
// Akhir Route Hak akses Pimpinan


// Awal Route Hak Akses Superadmin
Route::prefix('superadmin')->middleware('auth', 'cek_login:1')->group(function () {
	Route::view('dashboard', 'superadmin.dashboard')->name('superadmin');
	Route::view('peta', 'superadmin.peta')->name('peta');
	Route::resource('userlog', \App\Http\Controllers\Admin\UserlogController::class);
	Route::resource('dusun', \App\Http\Controllers\Admin\DusunController::class);
	Route::resource('desa', \App\Http\Controllers\Admin\DesaController::class);
	Route::resource('kecamatan', \App\Http\Controllers\Admin\KecamatanController::class);
	Route::resource('kelaspendidikan', \App\Http\Controllers\Admin\KelasPendidikanController::class);
	Route::resource('pendidikan', \App\Http\Controllers\Admin\PendidikanController::class);
	Route::resource('pekerjaan', \App\Http\Controllers\Admin\PekerjaanController::class);
	Route::resource('survior', \App\Http\Controllers\Admin\SurviorController::class);
	Route::resource('verifikator', \App\Http\Controllers\Admin\VerifikatorController::class);
	Route::resource('anak', \App\Http\Controllers\Admin\AnakController::class);
	Route::resource('koordinator', \App\Http\Controllers\Admin\KoordinatorController::class);
	// Route::get('/get-kecamatan/{id}', [\App\Http\Controllers\Admin\AnakController::class, 'getKecamatanById'])->name('get.kecamatan');
	// Route::get('/get-kecamatan/{id}', [AdminAnakController::class, 'getKecamatan']);
	// Route::get('/get-kecamatan-by-survior/{id}', 'App\Http\Controllers\Admin\AnakController@getKecamatanBySurvior');
	// get data export
	Route::get('anak/getKecamatanBySurvior', 'App\Http\Controllers\Admin\AnakController@getKecamatanBySurvior')->name('anak.getKecamatanBySurvior');

	Route::get('anakex', [\App\Http\Controllers\Admin\AnakController::class, 'anakex']);

	// get data desa untuk json
	Route::get('getdesa', [\App\Http\Controllers\Admin\DusunController::class, 'getdesa']);
	Route::get('all_anak', [\App\Http\Controllers\Admin\AnakController::class, 'all_anak']);

	Route::resource('role', RoleController::class);
});
// Akhir Route Hak Akses Superadmin
