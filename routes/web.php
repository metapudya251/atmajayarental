<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\PemilikController;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DetailJadwalController;
use App\Http\Controllers\TransaksiController;

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
    return view('welcome');
});

// Route::get('/profil', function () {
//     return view('dashboard.pegawai.profil');
// });

Auth::routes();

Route::prefix('home')->name('home.')->group(function(){
    Route::middleware(['guest:pegawai','guest:customer','PreventBackHistory'])->group(function(){
        Route::view('/home','welcome')->name('home');
    });
    // Route::middleware(['auth:customer','PreventBackHistory'])->group(function(){
    //     Route::view('/home','welocome')->name('home');
    // });
});

Route::prefix('pegawai')->name('pegawai.')->group(function(){
    Route::middleware(['guest:pegawai','PreventBackHistory'])->group(function(){
        Route::view('/login','dashboard.pegawai.login')->name('login');
        Route::post('/check',[PegawaiController::class,'check'])->name('check');
    });

    Route::middleware(['auth:pegawai','PreventBackHistory','admin'])->group(function(){
        // Route::view('/home','dashboard.pegawai.home')->name('home');
        Route::post('/logout',[PegawaiController::class,'logout'])->name('logout');
        Route::get('/index',[PegawaiController::class,'index'])->name('index');     //panggil halaman profil pegawai
        Route::get('/read',[PegawaiController::class,'read'])->name('read');        //panggil halaman data pegawai
        Route::get('/destroy/{id}',[PegawaiController::class,'destroy'])->name('destroy');      //panggil method delete
        Route::get('/show/{id}',[PegawaiController::class,'show'])->name('show');       //panggil halaman show detail
        Route::get('/edit/{id}',[PegawaiController::class,'edit'])->name('edit');           //panggil halaman edit
        Route::put('/update/{id}',[PegawaiController::class,'update'])->name('update');     //panggil methode editnya
        Route::post('/store',[PegawaiController::class,'store'])->name('store');     //panggil methode tambah
        Route::get('/create',[PegawaiController::class,'create'])->name('create');    //panggil halaman tambah
    });
    Route::middleware(['auth:pegawai','PreventBackHistory'])->group(function(){
        // Route::view('/home','dashboard.pegawai.home')->name('home');
        Route::view('/home','welcome')->name('home');
        Route::post('/logout',[PegawaiController::class,'logout'])->name('logout');
        Route::get('/index',[PegawaiController::class,'index'])->name('index');     //panggil halaman profil pegawai
        Route::get('/edit/{id}',[PegawaiController::class,'edit'])->name('edit');           //panggil halaman edit
        Route::put('/update/{id}',[PegawaiController::class,'update'])->name('update');     //panggil methode editnya
    });

});

Route::prefix('promo')->name('promo.')->group(function(){
    Route::middleware(['auth:pegawai','PreventBackHistory','manager'])->group(function(){
        Route::get('/index',[PromoController::class,'index'])->name('index');     //panggil halaman promo
        Route::get('/destroy/{id}',[PromoController::class,'destroy'])->name('destroy');      //panggil method delete
        Route::get('/show/{id}',[PromoController::class,'show'])->name('show');       //panggil halaman show detail
        Route::get('/edit/{id}',[PromoController::class,'edit'])->name('edit');           //panggil halaman edit
        Route::put('/update/{id}',[PromoController::class,'update'])->name('update');     //panggil methode editnya
        Route::post('/store',[PromoController::class,'store'])->name('store');     //panggil methode tambah
        Route::get('/create',[PromoController::class,'create'])->name('create');    //panggil halaman tambah
    });
});

Route::prefix('driver')->name('driver.')->group(function(){
    Route::middleware(['auth:pegawai','PreventBackHistory','admin'])->group(function(){
        Route::get('/index',[DriverController::class,'index'])->name('index');     //panggil halaman driver
        Route::get('/destroy/{id}',[DriverController::class,'destroy'])->name('destroy');      //panggil method delete
        Route::get('/show/{id}',[DriverController::class,'show'])->name('show');       //panggil halaman show detail
        Route::get('/edit/{id}',[DriverController::class,'edit'])->name('edit');           //panggil halaman edit
        Route::put('/update/{id}',[DriverController::class,'update'])->name('update');     //panggil methode editnya
        Route::post('/store',[DriverController::class,'store'])->name('store');     //panggil methode tambah
        Route::get('/create',[DriverController::class,'create'])->name('create');    //panggil halaman tambah
    });
});

Route::prefix('pemilik')->name('pemilik.')->group(function(){
    Route::middleware(['auth:pegawai','PreventBackHistory','admin'])->group(function(){
        Route::get('/index',[PemilikController::class,'index'])->name('index');     //panggil halaman pemilik
        Route::get('/destroy/{id}',[PemilikController::class,'destroy'])->name('destroy');      //panggil method delete
        Route::get('/show/{id}',[PemilikController::class,'show'])->name('show');       //panggil halaman show detail
        Route::get('/edit/{id}',[PemilikController::class,'edit'])->name('edit');           //panggil halaman edit
        Route::put('/update/{id}',[PemilikController::class,'update'])->name('update');     //panggil methode editnya
        Route::post('/store',[PemilikController::class,'store'])->name('store');     //panggil methode tambah
        Route::get('/create',[PemilikController::class,'create'])->name('create');    //panggil halaman tambah
        Route::post('/new',[PemilikController::class,'new'])->name('new');     //panggil methode tambah
        Route::get('/add',[PemilikController::class,'add'])->name('add');    //panggil halaman tambah
    });
});

Route::prefix('aset')->name('aset.')->group(function(){
    Route::middleware(['auth:pegawai','PreventBackHistory','admin'])->group(function(){
        Route::get('/index',[AsetController::class,'index'])->name('index');     //panggil halaman pemilik
        Route::get('/destroy/{id}',[AsetController::class,'destroy'])->name('destroy');      //panggil method delete
        Route::get('/show/{id}',[AsetController::class,'show'])->name('show');       //panggil halaman show detail
        Route::get('/edit/{id}',[AsetController::class,'edit'])->name('edit');           //panggil halaman edit
        Route::put('/update/{id}',[AsetController::class,'update'])->name('update');     //panggil methode editnya
        Route::post('/store',[AsetController::class,'store'])->name('store');     //panggil methode tambah
        Route::get('/create',[AsetController::class,'create'])->name('create');    //panggil halaman tambah
        Route::get('/updateKategori/{id}',[AsetController::class,'updateKategori'])->name('updateKategori'); //panggil methode editnya
        Route::get('/changeKategori',[AsetController::class,'changeKategori'])->name('changeKategori'); //panggil methode editnya
    });
});

Route::prefix('customer')->name('customer.')->group(function(){
    Route::middleware(['guest:customer','PreventBackHistory'])->group(function(){
        Route::view('/login','dashboard.customer.login')->name('login');
        Route::view('/register','dashboard.customer.register')->name('register');
        Route::post('/add',[CustomerController::class,'add'])->name('add');     //panggil halaman tambah regis
        Route::post('/check',[CustomerController::class,'check'])->name('check');
    });
    Route::middleware(['auth:customer','PreventBackHistory'])->group(function(){
        Route::view('/home','welcome')->name('home');
        Route::post('/logoutC',[CustomerController::class,'logoutC'])->name('logoutC');
        Route::view('/profil','dashboard.customer.profil')->name('profil');         //panggil profil customer
        Route::get('/index',[CustomerController::class,'index'])->name('index');     //panggil dashboard customer
        Route::get('/edit/{id}',[CustomerController::class,'edit'])->name('edit');           //panggil halaman edit
        Route::put('/update/{id}',[CustomerController::class,'update'])->name('update');     //panggil methode editnya
        Route::get('/updateVerifCust/{id}',[CustomerController::class,'updateVerifCust'])->name('updateVerifCust');     //panggil methode editnya
    });
    Route::middleware(['auth:pegawai','PreventBackHistory','cs'])->group(function(){
        Route::post('/logout',[PegawaiController::class,'logout'])->name('logout');
        Route::get('/read',[CustomerController::class,'read'])->name('read');        //panggil halaman data customer for CS
        Route::get('/destroy/{id}',[CustomerController::class,'destroy'])->name('destroy');      //panggil method delete
        Route::get('/show/{id}',[CustomerController::class,'show'])->name('show');       //panggil halaman show detail
        Route::post('/store',[CustomerController::class,'store'])->name('store');     //panggil methode tambah
        Route::get('/create',[CustomerController::class,'create'])->name('create');    //panggil halaman tambah
    });
});

Route::prefix('jadwal')->name('jadwal.')->group(function(){
    Route::middleware(['auth:pegawai','PreventBackHistory','manager'])->group(function(){
        Route::get('/index',[DetailJadwalController::class,'index'])->name('index');     //panggil halaman promo
        Route::get('/destroy/{id}',[DetailJadwalController::class,'destroy'])->name('destroy');      //panggil method delete
        Route::get('/show/{id}',[DetailJadwalController::class,'show'])->name('show');       //panggil halaman show detail
        Route::get('/edit/{id}',[DetailJadwalController::class,'edit'])->name('edit');           //panggil halaman edit
        Route::put('/update/{id}',[DetailJadwalController::class,'update'])->name('update');     //panggil methode editnya
        Route::post('/store',[DetailJadwalController::class,'store'])->name('store');     //panggil methode tambah
        Route::get('/create',[DetailJadwalController::class,'create'])->name('create');    //panggil halaman tambah
    });
});

Route::prefix('transaksi')->name('transaksi.')->group(function(){
    Route::middleware(['auth:customer','PreventBackHistory'])->group(function(){
        Route::get('/indexCust',[TransaksiController::class,'indexCust'])->name('indexCust');     //panggil halaman promo
        Route::get('/custHistory',[TransaksiController::class,'custHistory'])->name('custHistory');     //panggil halaman promo
        Route::get('/destroy/{id}',[TransaksiController::class,'destroy'])->name('destroy');      //panggil method delete
        Route::get('/show/{id}',[TransaksiController::class,'show'])->name('show');       //panggil halaman show detail
        Route::get('/showCust/{id}',[TransaksiController::class,'showCust'])->name('showCust');       //panggil halaman show detail
        Route::get('/showCust2/{id}',[TransaksiController::class,'showCust2'])->name('showCust2');       //panggil halaman show detail
        Route::get('/edit/{id}',[TransaksiController::class,'edit'])->name('edit');           //panggil halaman edit
        Route::get('/editBayar/{id}',[TransaksiController::class,'editBayar'])->name('editBayar');           //panggil halaman edit
        Route::put('/update/{id}',[TransaksiController::class,'update'])->name('update');     //panggil methode editnya
        Route::put('/updateBukti/{id}',[TransaksiController::class,'updateBukti'])->name('updateBukti');     //panggil methode editnya
        Route::post('/store',[TransaksiController::class,'store'])->name('store');     //panggil methode tambah
        Route::get('/create/{id}',[TransaksiController::class,'create'])->name('create');    //panggil halaman tambah
        Route::get('/cetakNota3/{id}',[TransaksiController::class,'cetakNota'])->name('cetakNota3');       //panggil halaman show detail
        Route::get('/cetakNota4/{id}',[TransaksiController::class,'cetakNota1'])->name('cetakNota4');       //panggil halaman show detail
    });
    Route::middleware(['auth:pegawai','PreventBackHistory','cs'])->group(function(){
        Route::get('/index',[TransaksiController::class,'index'])->name('index');     //panggil halaman promo
        Route::get('/indexTransaksi',[TransaksiController::class,'indexTransaksi'])->name('indexTransaksi');     //panggil halaman promo
        Route::get('/history',[TransaksiController::class,'history'])->name('history');     //panggil halaman promo
        Route::get('/show/{id}',[TransaksiController::class,'show'])->name('show');       //panggil halaman show detail
        Route::get('/showHistory/{id}',[TransaksiController::class,'showHistory'])->name('showHistory');       //panggil halaman show detail
        Route::get('/showVerif/{id}',[TransaksiController::class,'showVerif'])->name('showVerif');       //panggil halaman show detail
        Route::get('/showNota/{id}',[TransaksiController::class,'showNota'])->name('showNota');       //panggil halaman show detail
        Route::get('/cetakNota/{id}',[TransaksiController::class,'cetakNota'])->name('cetakNota');       //panggil halaman show detail
        Route::get('/cetakNota1/{id}',[TransaksiController::class,'cetakNota1'])->name('cetakNota1');       //panggil halaman show detail
        Route::get('/updateStatus/{id}',[TransaksiController::class,'updateStatus'])->name('updateStatus'); //panggil methode editnya
        Route::get('/updateVerif/{id}',[TransaksiController::class,'updateVerif'])->name('updateVerif'); //panggil methode editnya
        Route::get('/updateBayar/{id}',[TransaksiController::class,'updateBayar'])->name('updateBayar'); //panggil methode editnya
        
    });
});

