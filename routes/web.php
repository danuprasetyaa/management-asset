<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingContorller;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\RentalIdController;
use App\Http\Controllers\PengirimanController;
use App\Http\Controllers\TagihanController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/dasboard', [LandingContorller::class, 'dasboard'])->name('management-asset/dasboard')->middleware('auth');

Route::get('/asset', [AssetController::class, 'asset'])->name('management-asset/asset')->middleware('auth');
Route::post('/asset/add', [AssetController::class, 'addasset'])->name('addasset');  

Route::get('/rental', [RentalController::class, 'rental'])->name('management-asset/rental');
Route::post('/project/add', [RentalController::class, 'addproject'])->name('addproject');

Route::get('/project/{project}', [PengirimanController::class, 'projecttampil'])->name('project.tampil');

Route::get('/pengiriman/{project}/dashboard-pengiriman', [PengirimanController::class, 'pengiriman'])->name('components.pengiriman');
Route::post('/pengiriman', [PengirimanController::class, 'kirim'])->name('kirim');

Route::get ('/project/{project}/dashboard-tagihan', [TagihanController::class, 'tagihanrental'])->name('dashboardtagihan');
Route::post('/project/{project}/tagihan',           [TagihanController::class, 'buattagihan'])    ->name('buattagihan.modals');
Route::get ('/tagihan/{tagihan}/detail',             [TagihanController::class, 'detailshow'])    ->name('detailtagihan');


Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login',[LoginController::class,'login'])->name('login.success');
Route::post('/logout',[LoginController::class,'logout'])->name('logout');

