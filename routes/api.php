<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BookingGymController;
use App\Http\Controllers\PresensiInstrukturController;
use App\Http\Controllers\BookingKelasController;
use App\Http\Controllers\InstrukturController;
use App\Http\Controllers\IzinInstrukturController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post("loginapi", "App\Http\Controllers\LoginController@login");
Route::group(['middleware' => 'auth:member-api,pegawai-api,instruktur-api'], function(){

    Route::post("logout", "App\Http\Controllers\LoginController@logout");
});

Route::post(
    "ubahPassword",
    "App\Http\Controllers\LoginController@ubahPassword"
);

Route::get("index","App\Http\Controllers\JadwalHarianController@indexApi");

Route::get("indexGym/{id}","App\Http\Controllers\BookingGymController@indexBookingGym");

Route::get("indexPresensiInstruktur","App\Http\Controllers\PresensiInstrukturController@indexPresensiInstruktur");
Route::post("storePresensiInstruktur","App\Http\Controllers\PresensiInstrukturController@storePresensiInstruktur");

Route::delete("batalGym/{id}","App\Http\Controllers\BookingGymController@batalGym");

Route::post("storeGym","App\Http\Controllers\BookingGymController@store");

Route::get(
    "dataInstruktur/{id}",
    "App\Http\Controllers\InstrukturController@getDataInstruktur"
);

Route::get(
    "dataMember/{id}",
    "App\Http\Controllers\MemberController@getDataMember"
);

Route::get(
    "indexBookingKelasMobile/{id}",
    "App\Http\Controllers\BookingKelasController@indexBookingKelasMobile"
);

Route::post(
    "addBookingKelasMobile",
    "App\Http\Controllers\BookingKelasController@addBookingKelasMobile"
);

Route::delete(
    "delBookingKelasMobile/{id}",
    "App\Http\Controllers\BookingKelasController@delBookingKelasMobile"
);



Route::get(
    "dataAktivitasInstruktur/{id}",
    "App\Http\Controllers\InstrukturController@getHistoriAktivitasInstruktur"
);

Route::get(
    "izinInstruktur/{id}",
    "App\Http\Controllers\IzinInstrukturController@dataInstruktur"
);

Route::get(
    "getJadwal/{id}",
    "App\Http\Controllers\IzinInstrukturController@getJadwal"
);

Route::post(
    "tambahIzin",
    "App\Http\Controllers\IzinInstrukturController@tambahIzin"
);

Route::get(
    "getHistoryMember/{id}",
    "App\Http\Controllers\BookingKelasController@getHistoryMember"
);

Route::get('index_jadwal_presensi/{id}','App\Http\Controllers\BookingKelasController@index_jadwal_presensi');

Route::get('index_histori_jadwal_presensi/{id}','App\Http\Controllers\BookingKelasController@index_histori_jadwal_presensi');

Route::post('update_transaksi','App\Http\Controllers\BookingKelasController@update_transaksi');