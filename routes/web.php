<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\PengajuController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\KepalaDesaController;

use Illuminate\Http\Request;

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

Route::get('/clear', function() {
	Artisan::call('cache:clear');
	Artisan::call('config:cache');
	dd("Sudah Bersih nih!, Silahkan Kembali ke Halaman Utama");
});
// Route::get('/',[HomeController::class,'index'])->name('index');
Route::post('add-act-kode-true',[HomeController::class,'buat_kode'])->name('buat_kode');
Route::post('cek-kode-akses',[HomeController::class,'masuk'])->name('masuk');
Route::post('scan-qrcode/validasi', [HomeController::class, 'validasiQrcode'])->name('validasiqrcode');
Route::get('pendaftaran-desa/{url_kode}',[HomeController::class,'pendaftaran'])->name('pendaftaran');
// Route::get('dropdown',[DropdownController::class, 'index']);
Route::get('pendaftaran_desa/change/profil_change',[HomeController::class, 'change_profil']);
Route::post('pendaftaran-desa/tambah-data/{url_kode}',[HomeController::class, 'tambah_pendaftaran'])->name('tambah_pendaftaran');

// home desa
Route::get('/',[HomeController::class, 'index'])->name('index');
// Route::get('{title}/auth-register',[HomeController::class,'register'])->name('register');
Route::post('register/daftar',[HomeController::class,'daftar'])->name('daftar');
Route::get('auth',[HomeController::class,'login'])->name('login');
Route::post('login/ceklogin',[HomeController::class,'ceklogin'])->name('ceklogin');
Route::post('auth/forgot-password/cek-data', [HomeController::class,'proses_forgot'])->name('proses_forgot');

// Route::get('{title}/auth-lupa-password', [HomeController::class,'forgot'])->name('forgot');
// Route::post('auth/forgot-password/verfikasi-kode', [HomeController::class,'cek_verifikasi'])->name('cek_verifikasi');
// Route::post('{title}/auth/forgot-password/ubah-password/proses', [HomeController::class,'ubah_password'])->name('ubah_password');

Route::middleware(['auth', 'ceklevel:Admin'])->prefix('page')->group(function() {
// Route::group(['middleware'=>['auth','ceklevel:Desa']],function()
// {
	Route::get('dashboard',[DesaController::class,'dashboard'])->name('dashboard');
// Dashboard Desa
// Profil Desa
	Route::get('profil_app',[DesaController::class,'profil_desa'])->name('profil_desa');
	Route::post('profil_app/ganti-password/{id}',[DesaController::class,'ganti_password'])->name('ganti_password');
	Route::post('profil_app/update',[DesaController::class,'lengkapi'])->name('lengkapi');

// User
	Route::get('user/{level}',[DesaController::class,'data_user'])->name('data_user');
	// Route::get('user-pengurus',[DesaController::class,'user_pengurus'])->name('user_pengurus');
	Route::post('data_user/tambah',[DesaController::class,'tambah_pengurus'])->name('tambah_pengurus');
	Route::get('data_user/get_edit/{id}',[DesaController::class,'get_edit_user'])->name('get_edit_user');
	Route::post('data_user/update',[DesaController::class,'update_pengurus'])->name('update_pengurus');
	Route::get('user/view/{id}',[DesaController::class,'cek_user'])->name('cek_user');
// Data Surat
	Route::get('surat',[DesaController::class,'data_surat'])->name('data_surat');
	Route::post('surat/tambah',[DesaController::class,'tambah_surat'])->name('tambah_surat');
	Route::get('surat/get_edit/{id_surat}',[DesaController::class,'get_edit_surat']);
	Route::post('surat/edit/',[DesaController::class,'edit_surat'])->name('edit_surat');
	Route::get('surat/hapus/{id_surat}',[DesaController::class,'hapus_surat'])->name('hapus_surat');
// Waktu Layanan
	Route::get('waktu_pelayanan',[DesaController::class,'waktu_layanan'])->name('waktu_layanan');
	Route::post('waktu_pelayanan/save',[DesaController::class,'tambah_layanan'])->name('tambah_layanan');
	Route::get('waktu_pelayanan/get_edit/{id_layanan}',[DesaController::class,'get_edit_layanan']);
	Route::post('waktu_pelayanan/update',[DesaController::class,'edit_layanan'])->name('edit_layanan');
	Route::get('waktu_pelayanan/hapus/{id_layanan}',[DesaController::class,'hapus_layanan'])->name('hapus_layanan');
// Prosedur
	Route::get('prosedur',[DesaController::class,'prosedur'])->name('prosedur');
	Route::post('prosedur/tambah',[DesaController::class,'tambah_prosedur'])->name('tambah_prosedur');
	Route::post('prosedur/edit/{id_prosedur}',[DesaController::class,'edit_prosedur'])->name('edit_prosedur');
	Route::get('prosedur/hapus/{id_prosedur}',[DesaController::class,'hapus_prosedur'])->name('hapus_prosedur');

	Route::get('template-surat/{id_surat}',[DesaController::class,'template'])->name('template');
	Route::post('template-surat/custom-template/{template_id}',[DesaController::class,'custom_template'])->name('custom_template');
});

Route::middleware(['auth', 'ceklevel:Pengaju'])->prefix('page/pengaju')->group(function() {
// Route::group(['middleware'=>['auth','ceklevel:Pengaju,Staff,Kepala Desa']],function()
// {
	Route::get('request',[PengajuController::class,'dashboard_pengaju'])->name('dashboard_pengaju');
// Pengaju
	Route::get('request/{id_surat}/{surat}',[PengajuController::class,'request'])->name('request');
	Route::post('request/save_request',[PengajuController::class,'add_request'])->name('add_request');
	Route::get('data_pengajuan/{id_surat}/{singkatan}',[PengajuController::class,'data_request'])->name('data_request');
	
});

// Route::group(['middleware'=>['auth','ceklevel:Pengaju,Staff,Kepala Desa']],function()
Route::middleware(['auth', 'ceklevel:Pengaju,Staff,Dekan,Admin'])->prefix('page/pengaju')->group(function() {
	Route::get('profile',[PengajuController::class,'profil_pengaju'])->name('profil_pengaju');
	Route::post('profile/update',[PengajuController::class,'update_profil_pengurus'])->name('update_profil_pengurus');
});

Route::middleware(['auth', 'ceklevel:Staff,Dekan'])->prefix('page/petugas')->group(function() {
// Staff
	Route::get('dashboard-staff',[StaffController::class,'dashboard_staff'])->name('dashboard_staff');
	Route::get('pengajuan_permohonan/{id_surat}/{surat}',[StaffController::class,'staff_acc'])->name('staff_acc');
	Route::get('pengajuan_permohonan/validasi/{surat}/{id_pengajuan}',[StaffController::class,'staff_cek_berkas'])->name('staff_cek_berkas');
	Route::post('pengajuan_permohonan/acc_status/{id_pengajuan}',[StaffController::class,'keterangan'])->name('keterangan');
	Route::get('pengajuan_permohonan/konfirmasi/{surat}/{id_pengajuan}',[StaffController::class,'konfirmasi'])->name('konfirmasi');

	Route::get('pengajuan_permohonan/cetak_surat/{id_surat}/{surat}',[StaffController::class,'staff_cetak'])->name('staff_cetak');
	Route::get('pengajuan_permohonan/cetak_surat/view/{surat}/{id_pengajuan}',[StaffController::class,'cetak'])->name('cetak');
	Route::get('pengajuan_permohonan/surat_selesai',[StaffController::class,'surat_selesai'])->name('surat_selesai');
	Route::get('pengajuan_permohonan/laporan',[StaffController::class,'laporan'])->name('laporan');
	Route::get('pengajuan_permohonan/laporan/export/{awal}/{akhir}',[StaffController::class,'print'])->name('print');

// Kepala Desa
	Route::get('dashboard-dekan',[KepalaDesaController::class,'dashboard_kepaladesa'])->name('dashboard_kepaladesa');
	Route::get('pengajuan_permohonan/kades/{id_surat}/{surat}',[KepalaDesaController::class,'kepaladesa_acc'])->name('kepaladesa_acc');
	Route::get('pengajuan_permohonan/kades/view/{surat}/{id_pengajuan}',[KepalaDesaController::class,'ttd'])->name('ttd');
	// Route::get('pengajuan/permohonan-surat/kepaladesa/cek-surat/form-ttd/{id_pengajuan}',[KepalaDesaController::class,'form_ttd'])->name('form_ttd');
	Route::post('pengajuan_permohonan/kades/save_ttd',[KepalaDesaController::class,'ttd_upload'])->name('ttd_upload');
	Route::post('pengajuan/permohonan-surat/kepaladesa/cek-surat/ttd/confirm/{id_pengajuan}',[KepalaDesaController::class,'confirm_ttd'])->name('confirm_ttd');
});

Route::group(['middleware'=>'auth'],function()
{
	Route::get('pengajuan/export/{surat}/{id_pengajuan}',[StaffController::class,'cetak_surat'])->name('cetak_surat');
});

Route::get('back/auth-logout',[HomeController::class,'logout'])->name('logout');