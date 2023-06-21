<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\InstrukturController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\JadwalHarianController;
use App\Http\Controllers\TransaksiAktivasiController;
use App\Http\Controllers\TransaksiUangController;
use App\Http\Controllers\TransaksiKelasController;
use App\Http\Controllers\IzinInstrukturController;
use App\Http\Controllers\BookingKelasController;
use App\Http\Controllers\BookingGymController;
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
Route::get("/", [LoginController::class, "index"]);
Route::get("/indexGantiPassword", [LoginController::class, "indexGantiPassword"]);
Route::post("/ubahPasswordPegawai", [LoginController::class, "ubahPasswordPegawai"]);

Route:: post("/login", [LoginController::class,"login"]);

Route:: get("/logout", [LoginController::class,"logout"]);

Route::get("/dashboard", [DashboardController::class, "index"]);

Route::get("/member", [MemberController::class, "index"]);
Route::get("/addPageMember", [MemberController::class, "addPage"]);
Route::get("/editPageMember/{id}", [MemberController::class, "editPage"]);
Route::delete("/deleteMember/{id}", [MemberController::class, "destroy"]);
Route::post("/storeMember", [MemberController::class, "store"]);
Route::put("/editMember/{id}", [MemberController::class, "update"]);
Route::get("/searchMember", [MemberController::class, "search"]);
Route::get("/reset_password/{id}", [MemberController::class, "reset_password"]);
Route::get("/cardMember/{id}", [MemberController::class, "cardMember"]);



Route::get("/instruktur", [InstrukturController::class, "index"]);
Route::get("/addPageInstruktur", [InstrukturController::class, "addPage"]);
Route::get("/editPageInstruktur/{id}", [InstrukturController::class, "editPage"]);
Route::delete("/deleteInstruktur/{id}", [InstrukturController::class, "destroy"]);
Route::post("/storeInstruktur", [InstrukturController::class, "store"]);
Route::put("/editInstruktur/{id}", [InstrukturController::class, "update"]);
Route::get("/searchInstruktur", [InstrukturController::class, "search"]);

Route::get("/jadwal", [JadwalController::class, "index"]);
Route::get("/addPageJadwal", [JadwalController::class, "addPage"]);
Route::post("/storeJadwal", [JadwalController::class, "store"]);
Route::get("/editPageJadwal/{id}", [JadwalController::class, "editPage"]);
Route::put("/editJadwal/{id}", [JadwalController::class, "update"]);
Route::delete("/deleteJadwal/{id}", [JadwalController::class, "destroy"]);

Route::get("/jadwalHarian", [JadwalHarianController::class, "index"]);
Route::get("/generateJadwal", [JadwalHarianController::class, "generateJadwal"]);
Route::get("/editPageJadwalHarian/{id}", [JadwalHarianController::class, "editPage"]);
Route::put("/editJadwalHarian/{id}", [JadwalHarianController::class, "update"]);
Route::get("/searchJadwalHarian", [JadwalHarianController::class, "search"]);


Route::get("/transaksiAktivasi", [TransaksiAktivasiController::class, "index"]);
Route::get("/addPageAktivasi", [TransaksiAktivasiController::class, "addPageAktivasi"]);
Route::get("/konfirmasiAktivasi", [TransaksiAktivasiController::class, "konfirmasiAktivasi"]);
Route::post("/storeAktivasi", [TransaksiAktivasiController::class, "store"]);
Route::get("/kuitansi/{id}", [TransaksiAktivasiController::class, "kuitansi"]);


Route::get("/transaksiUang", [TransaksiUangController::class, "index"]);
Route::get("/kuitansiUang/{id}", [TransaksiUangController::class, "kuitansi"]);
Route::get("/addPageTransaksiUang", [TransaksiUangController::class, "addPage"]);
Route::get("/konfirmasiUang", [TransaksiUangController::class, "konfirmasiUang"]);
Route::post("/storeUang", [TransaksiUangController::class, "store"]);


Route::get("/transaksiKelas", [TransaksiKelasController::class, "index"]);
Route::get("/kuitansiKelas/{id}", [TransaksiKelasController::class, "kuitansi"]);
Route::get("/addPageTransaksiKelas", [TransaksiKelasController::class, "addPage"]);
Route::get("/konfirmasiKelas", [TransaksiKelasController::class, "konfirmasiKelas"]);
Route::post("/storeKelas", [TransaksiKelasController::class, "store"]);


Route::get("/deaktivasiPage", [MemberController::class, "deaktivasiMemberPage"]);
Route::get("/deaktivasiMember", [MemberController::class, "deaktivasiMember"]);


Route::get("/resetKelasMemberPage", [MemberController::class, "resetKelasMemberPage"]);
Route::get("/resetKelasMember", [MemberController::class, "resetKelasMember"]);

Route::get("/resetTerlambatPage", [InstrukturController::class, "resetTerlambatPage"]);
Route::get("/resetTerlambat", [InstrukturController::class, "resetTerlambat"]);


Route::get("/izinInstruktur", [IzinInstrukturController::class, "index"]);
Route::get("/konfirmasiIzin/{id}", [IzinInstrukturController::class, "konfirmasi"]);


Route::get("/bookingKelas", [BookingKelasController::class, "index"]);
Route::get("/cetakStrukBookingKelas/{id}", [BookingKelasController::class, "cetakStruk"]);

Route::get("/bookingGym", [BookingGymController::class, "index"]);
Route::get("/konfirmasiBookingGym/{id}", [BookingGymController::class, "konfirmasiBookingGym"]);
Route::get("/cetakStrukBookingGym/{id}", [BookingGymController::class, "cetakStruk"]);


Route::get("/indexLaporanPendapatan", [LaporanController::class, "indexLaporanPendapatan"]);
Route::get("/laporanPendapatan", [LaporanController::class, "laporanPendapatan"]);

Route::get("/indexLaporanGym", [LaporanController::class, "indexLaporanGym"]);
Route::get("/laporanGym", [LaporanController::class, "laporanGym"]);


Route::get("/indexLaporanKelas", [LaporanController::class, "indexLaporanKelas"]);
Route::get("/laporanKelas", [LaporanController::class, "laporanKelas"]);


Route::get("/indexLaporanInstruktur", [LaporanController::class, "indexLaporanInstruktur"]);
Route::get("/laporanInstruktur", [LaporanController::class, "laporanInstruktur"]);

