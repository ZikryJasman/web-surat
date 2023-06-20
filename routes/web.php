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
Route::get('/',[HomeController::class,'index'])->name('index');

// home desa
Route::get('{title}',[HomeController::class, 'home_desa'])->name('home_desa');
Route::get('{title}/auth-register',[HomeController::class,'register'])->name('register');
Route::post('register/daftar',[HomeController::class,'daftar'])->name('daftar');
Route::get('{title}/auth-login',[HomeController::class,'login'])->name('login');
Route::post('login/ceklogin',[HomeController::class,'ceklogin'])->name('ceklogin');

Route::get('{title}/auth-lupa-password', [HomeController::class,'forgot'])->name('forgot');
Route::post('auth/forgot-password/cek-data', [HomeController::class,'proses_forgot'])->name('proses_forgot');
Route::post('auth/forgot-password/verfikasi-kode', [HomeController::class,'cek_verifikasi'])->name('cek_verifikasi');
Route::post('{title}/auth/forgot-password/ubah-password/proses', [HomeController::class,'ubah_password'])->name('ubah_password');

Route::group(['middleware'=>['auth','ceklevel:Desa']],function()
{
	Route::get('dashboard/{title}',[DesaController::class,'dashboard'])->name('dashboard');
// Dashboard Desa
// Profil Desa
	Route::get('{title}/profil-desa',[DesaController::class,'profil_desa'])->name('profil_desa');
	Route::post('profil-desa/lengkapi/{id}',[DesaController::class,'lengkapi'])->name('lengkapi');

// User
	Route::get('{title}/user-pengaju',[DesaController::class,'user_pengaju'])->name('user_pengaju');
	Route::get('{title}/user-pengurus',[DesaController::class,'user_pengurus'])->name('user_pengurus');
	Route::post('user-pengurus/tambah',[DesaController::class,'tambah_pengurus'])->name('tambah_pengurus');
	Route::get('{title}/user/detail-user/{id}',[DesaController::class,'cek_user'])->name('cek_user');
// Data Surat
	Route::get('{title}/data-surat',[DesaController::class,'data_surat'])->name('data_surat');
	Route::post('data-surat/tambah',[DesaController::class,'tambah_surat'])->name('tambah_surat');
	Route::post('data-surat/edit/{id_surat}',[DesaController::class,'edit_surat'])->name('edit_surat');
	Route::get('data-surat/hapus/{id_surat}',[DesaController::class,'hapus_surat'])->name('hapus_surat');
// Waktu Layanan
	Route::get('{title}/data-waktu-pelayanan',[DesaController::class,'waktu_layanan'])->name('waktu_layanan');
	Route::post('data-waktu-pelayanan/tambah',[DesaController::class,'tambah_layanan'])->name('tambah_layanan');
	Route::post('data-waktu-pelayanan/edit/{id_layanan}',[DesaController::class,'edit_layanan'])->name('edit_layanan');
	Route::get('data-waktu-pelayanan/hapus/{id_layanan}',[DesaController::class,'hapus_layanan'])->name('hapus_layanan');
// Prosedur
	Route::get('{title}/data-prosedur',[DesaController::class,'prosedur'])->name('prosedur');
	Route::post('data-prosedur/tambah',[DesaController::class,'tambah_prosedur'])->name('tambah_prosedur');
	Route::post('data-prosedur/edit/{id_prosedur}',[DesaController::class,'edit_prosedur'])->name('edit_prosedur');
	Route::get('data-prosedur/hapus/{id_prosedur}',[DesaController::class,'hapus_prosedur'])->name('hapus_prosedur');

    // program
	Route::get('pengajuan/program',[DesaController::class,'programIndex'])->name('program.index');
	Route::post('pengajuan/program',[DesaController::class,'programStore'])->name('program.store');
	Route::post('pengajuan/program/{id}',[DesaController::class,'programUpdate'])->name('program.update');
	Route::get('pengajuan/program/hapus/{id}',[DesaController::class,'programDelete'])->name('program.delete');


	Route::get('{title}/template-surat/{id_surat}',[DesaController::class,'template'])->name('template');
	Route::post('template-surat/custom-template/{template_id}',[DesaController::class,'custom_template'])->name('custom_template');
});

Route::group(['middleware'=>['auth','ceklevel:Pengaju,Staff,Kepala Desa,Desa']],function()
{
	Route::post('profil-desa/ganti-password/{id}',[DesaController::class,'ganti_password'])->name('ganti_password');

	Route::get('pengajuan/dashboard-request',[PengajuController::class,'dashboard_pengaju'])->name('dashboard_pengaju');
	Route::post('pengajuan/dashboard-request/update-profil',[PengajuController::class,'update_profil_pengurus'])->name('update_profil_pengurus');
// Pengaju
	Route::get('pengajuan/dashboard/request-permohonan/{surat}',[PengajuController::class,'request'])->name('request');
	Route::post('pengajuan/dashboard/request-permohonan/add-permohonan',[PengajuController::class,'add_request'])->name('add_request');
	Route::get('pengajuan/dashboard/data-status-permohonan/{singkatan}',[PengajuController::class,'data_request'])->name('data_request');
	Route::get('pengajuan/detail-profile',[PengajuController::class,'profil_pengaju'])->name('profil_pengaju');

// Staff
	Route::get('pengajuan/dashboard-staff',[StaffController::class,'dashboard_staff'])->name('dashboard_staff');
	Route::get('pengajuan/permohonan-surat/staff-acc/{surat}',[StaffController::class,'staff_acc'])->name('staff_acc');
	Route::get('pengajuan/permohonan-surat/staff-acc/cek-perlengkapan-permohonan/{surat}/{id_pengajuan}',[StaffController::class,'staff_cek_berkas'])->name('staff_cek_berkas');
	Route::post('pengajuan/permohonan-surat/staff-acc/cek-perlengkapan-permohonan/keterangan/{id_pengajuan}',[StaffController::class,'keterangan'])->name('keterangan');
	Route::get('pengajuan/permohonan-surat/staff-acc/cek-perlengkapan-permohonan/konfirmasi/{surat}/{id_pengajuan}',[StaffController::class,'konfirmasi'])->name('konfirmasi');
	Route::get('pengajuan/permohonan-surat/staff/cek-surat/{surat}',[StaffController::class,'staff_cetak'])->name('staff_cetak');
	Route::get('pengajuan/permohonan-surat/staff/cek-surat/cetak/{surat}/{id_pengajuan}',[StaffController::class,'cetak'])->name('cetak');
	Route::get('pengajuan/permohonan-surat/cek-surat/cetak-pdf/{surat}/{id_pengajuan}',[StaffController::class,'cetak_surat'])->name('cetak_surat');
	Route::get('pengajuan/permohonan-surat/staff/surat-selesai',[StaffController::class,'surat_selesai'])->name('surat_selesai');
	Route::get('pengajuan/permohonan-surat/staff/laporan',[StaffController::class,'laporan'])->name('laporan');
	Route::get('pengajuan/permohonan-surat/staff/laporan/export/pdf',[StaffController::class,'exportPdf'])->name('exportPdf');
	Route::get('pengajuan/permohonan-surat/staff/laporan/print/{awal}/{akhir}',[StaffController::class,'print'])->name('print');

// Kepala Desa
	Route::get('pengajuan/dashboard-wakil-dekan',[KepalaDesaController::class,'dashboard_kepaladesa'])->name('dashboard_kepaladesa');
	Route::get('pengajuan/permohonan-surat/wakildekan/cek-surat/{surat}',[KepalaDesaController::class,'kepaladesa_acc'])->name('kepaladesa_acc');
	Route::get('pengajuan/permohonan-surat/wakildekan/cek-surat/ttd/{surat}/{id_pengajuan}',[KepalaDesaController::class,'ttd'])->name('ttd');
	Route::get('pengajuan/permohonan-surat/wakildekan/cek-surat/form-ttd/{id_pengajuan}',[KepalaDesaController::class,'form_ttd'])->name('form_ttd');
	Route::post('pengajuan/permohonan-surat/wakildekan/cek-surat/ttd/upload/{id_pengajuan}',[KepalaDesaController::class,'ttd_upload'])->name('ttd_upload');
	Route::post('pengajuan/permohonan-surat/wakildekan/cek-surat/ttd/confirm/{id_pengajuan}',[KepalaDesaController::class,'confirm_ttd'])->name('confirm_ttd');

});

Route::get('back/auth-logout',[HomeController::class,'logout'])->name('logout');
