<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\LaporanController;
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
// Route Public
route::get('/',[HomeController::class,'index'])->name('home');
route::get('/login',[LoginController::class,'halamanlogin'])->name('login');
route::get('/admin',[LoginController::class,'adminlogin'])->name('adminlogin');
route::post('/postlogin',[LoginController::class,'postlogin'])->name('postlogin');
route::post('/postadmin',[LoginController::class,'postadmin'])->name('postadmin');
route::get('/logout',[LoginController::class,'logout'])->name('logout');
// Route Middelware
Route::group(['middleware' => ['auth','CekLevel:admin,user']],function(){
    route::get('/home',[UsersController::class,'index'])->name('home');
    route::get('/users/{user}/absen',[UsersController::class,'absen'])->name('absen');
    route::post('tambahlaporan',[UsersController::class,'tambahlaporan']);
    route::resource('users', UsersController::class);
    route::resource('pengaturan', PengaturanController::class);
    route::get('/users/{users}/pulang',[UsersController::class,'absenpulang'])->name('pulang');;
    route::post('ubahlaporan',[UsersController::class,'ubahlaporan']);
    route::post('/updatelaporan/{users}',[UsersController::class,'updatelaporan']);
});
Route::group(['middleware' => ['auth','CekLevel:admin']],function(){
    // Users Route
    route::get('users/{user}',[UsersController::class,'store']); 
    route::get('hapususer/{user}',[UsersController::class,'destroy']); 
    route::get('users/{user}/edit',[UsersController::class,'edit']);
    // All
    route::get('/register',[LoginController::class,'register'])->name('register');   
    route::post('/simpanregister',[LoginController::class,'simpanregister'])->name('simpanregister');
    route::get('laporan',[UsersController::class,'laporan']);
    
    route::get('laporan/cari',[UsersController::class,'cariLaporan']);
    // Setting Route
    route::get('/setting',[PengaturanController::class,'index']); 
    route::get('pengaturan/{pengaturan}/edits',[PengaturanController::class,'edit']);
    route::get('/pengaturan/create',[PengaturanController::class,'create']);
    route::get('pengaturan',[PengaturanController::class,'store']);
    route::get('hapuspengaturan/{pengaturan}',[PengaturanController::class,'destroy']);
    // Laporan Route
    route::post('userimport',[UsersController::class,'userimport'])->name('userimport');
});



