<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IzinInstruktur;
use App\Models\Instruktur;
use App\Models\JadwalHarian;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class IzinInstrukturController extends Controller
{
    public function index()
    {
        $izinInstruktur = IzinInstruktur::all();
        return view("mo/izin_instruktur/dataizin")->with([
            "pegawai" => Auth::guard("pegawai")->user(),
            // "instrukturs" => $instruktur,
            "izinInstruktur" => $izinInstruktur,
        ]);
    }

    // public function konfirmasi($id)
    // {
    //     $izinInstruktur = IzinInstruktur::where("ID_IZIN_INSTRUKTUR", $id)->first();

    //     if ($izinInstruktur->STATUS_IZIN) {
    //         $izinInstruktur->STATUS_IZIN = 'diterima';
    //     }

    //     if ($izinInstruktur->TANGGAL_KONFIRMASI_IZIN) {
    //         $izinInstruktur->TANGGAL_KONFIRMASI_IZIN = Carbon::now()->format("Y-m-d");
    //     }

    //     $updateIzin = $izinInstruktur->update();

    //     if ($updateIzin) {
    //         return redirect()
    //             ->intended("izinInstruktur")
    //             ->with(["success" => "Berhasil mengupdate izin instruktur"]);
    //     }
    // }

    public function konfirmasi($id)
    {
        $izinInstruktur = izinInstruktur::orderby('ID_IZIN_INSTRUKTUR','desc')->where('ID_IZIN_INSTRUKTUR',$id)->first();

        if($izinInstruktur){
            $izinInstruktur->TANGGAL_KONFIRMASI_IZIN = Carbon::now();
            $izinInstruktur->STATUS_IZIN = 'Diterima';

            $jadwalHarian = jadwalHarian::where("TANGGAL_JADWAL_HARIAN",$izinInstruktur->TANGGAL_IZIN_INSTRUKTUR)->first();

            if($jadwalHarian) {
                if($izinInstruktur->NAMA_INSTRUKTUR_PENGGANTI){

                    $instruktur = Instruktur::where('NAMA_INSTRUKTUR',$izinInstruktur->NAMA_INSTRUKTUR_PENGGANTI)->first();
                    $instruktur2 = Instruktur::where('ID_INSTRUKTUR',$jadwalHarian->ID_INSTRUKTUR)->first();

                    if($instruktur) {
                        $jadwalHarian->ID_INSTRUKTUR = $instruktur->ID_INSTRUKTUR;
                        $jadwalHarian->STATUS_JADWAL_HARIAN = "Menggantikan ".$instruktur2->NAMA_INSTRUKTUR;
                    }
                }else {
                    $jadwalHarian->STATUS_JADWAL_HARIAN = 'Libur';
                } 
                $jadwalHarian->update();
            }
            $izinInstruktur->update();
            return redirect()->intended('/izinInstruktur')->with(['success' => 'Berhasil konfirmasi']);
        }
        return redirect()->intended('/izinInstruktur')->with(['error' => 'Gagal konfirmasi']);
    }

    public function dataInstruktur(Request $request, $id)
    {
        if ($request->expectsjson()) {
            $permission = IzinInstruktur::where('ID_INSTRUKTUR', $id)->get();
            if ($permission) {
                return response([
                    'message' => 'Successfully get data permission',
                    'data' => $permission,
                ], 200);
            }
            return response([
                'message' => 'Failed get data permission',
                'data' => null,
            ], 200);
        }
    }

    public function tambahIzin(Request $request)
    {
        if ($request->expectsJson()) {
            $validate = Validator::make($request->all(), [
                'TANGGAL_IZIN_INSTRUKTUR' => ['required'],
                'KETERANGAN_IZIN' => ['required'],
            ]);

            if ($validate->fails()) {
                return response(['success' => false, 'message' => $validate->errors()], 400);
            }

            if ($request->NAMA_INSTRUKTUR_PENGGANTI) {
                $instructor = Instruktur::where('NAMA_INSTRUKTUR', $request->NAMA_INSTRUKTUR_PENGGANTI)->first();
                if ($instructor) {
                    $temp_instructor = $instructor->NAMA_INSTRUKTUR;
                } else {
                    return response([
                        'message' => 'Instruktur  Not Found',
                        'data' => null,
                    ], 400);
                }
            } else {
                $temp_instructor = null;
            }

            $check = IzinInstruktur::where('TANGGAL_IZIN_INSTRUKTUR', $request->TANGGAL_IZIN_INSTRUKTUR)->exists();

            if ($check) {
                return response([
                    'message' => 'You have been create permission on this date',
                    'data' => null,
                ], 400);
            }

            $store_data = IzinInstruktur::create([
                'ID_INSTRUKTUR' => $request->ID_INSTRUKTUR,
                'TANGGAL_IZIN_INSTRUKTUR' => $request->TANGGAL_IZIN_INSTRUKTUR,
                'KETERANGAN_IZIN' => $request->KETERANGAN_IZIN,
                'TANGGAL_MELAKUKAN_IZIN' => Carbon::now(),
                'STATUS_IZIN' => null,
                'TANGGAL_KONFIRMASI_IZIN' => null,
                'NAMA_INSTRUKTUR_PENGGANTI' => $temp_instructor,
            ]);

            if ($store_data) {
                return response([
                    'message' => 'Successfully added permission',
                    'data' => $store_data,
                ], 200);
            }
            return response([
                'message' => 'Failed added permission',
                'data' => null,
            ], 400);
        }
    }

    public function getJadwal(Request $request, $id)
    {
        if ($request->expectsjson()) {
            $schedule = JadwalHarian::where("ID_INSTRUKTUR", $id)
                ->where("TANGGAL_JADWAL_HARIAN", ">", Carbon::now())
                ->get();
            if ($schedule) {
                return response(
                    [
                        "message" => "Successfully get data permission",
                        "data" => $schedule,
                    ],
                    200
                );
            }
            return response(
                [
                    "message" => "Failed get data permission",
                    "data" => null,
                ],
                200
            );
        }
    }

   
}
