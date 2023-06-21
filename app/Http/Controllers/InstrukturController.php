<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instruktur;
use App\Models\IzinInstruktur;
use App\Models\JadwalHarian;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validation;
use Carbon\Carbon;

class InstrukturController extends Controller
{
    public function index(){
        $instruktur = instruktur::all();

        return view("admin.data_instruktur.datainstruktur")->with ([
            'pegawai'=> Auth::guard('pegawai')->user(),
            'instruktur'=> $instruktur
        ]);
    }

    public function addPage(){
        return view("admin.data_instruktur.tambahdata")->with ([
            'pegawai'=> Auth::guard('pegawai')->user()
        ]);
    }

    public function editPage($id){
        $instruktur = instruktur::find($id);

        return view("admin.data_instruktur.editdata")->with ([
            'pegawai'=> Auth::guard('pegawai')->user(),
            'instruktur' => $instruktur
        ]);
    }

    public function destroy($id){
        $instruktur = Instruktur::where('ID_INSTRUKTUR',$id);
        $instruktur->delete();

        if($instruktur){
            return redirect()->intended('/instruktur')->with(['success' => 'Instruktur berhasil dihapus']);
        }
        return redirect()->intended('/')->with(['failed' => 'Instruktur gagal dihapus']);
    }

    public function store(Request $request)
    {   
        $validate = $request->validate(
            [
                "NAMA_INSTRUKTUR" => ["required"],
                "ALAMAT_INSTRUKTUR" => ["required"],
                "NO_TELEPON_INSTRUKTUR" => ["required"],
                "UMUR_INSTRUKTUR" => ["required"],
                "JENIS_KELAMIN_INSTRUKTUR" => ["required"],
                "EMAIL_INSTRUKTUR" => ["required"],
                "password" => ["required"],
                "TANGGAL_LAHIR_INSTRUKTUR" => ["required"]
            ],[
                "NAMA_INSTRUKTUR" => 'Nama Instruktur harus diisi',
                "ALAMAT_INSTRUKTUR" => 'Alamat Instruktur harus diisi',
                "NO_TELEPON_INSTRUKTUR" => 'No telepon Instruktur harus diisi',
                "UMUR_INSTRUKTUR" => 'Umur Instruktur harus diisi',
                "JENIS_KELAMIN_INSTRUKTUR" => 'Jenis kelamin Instruktur harus diisi',
                "EMAIL_INSTRUKTUR" => 'Email Instruktur harus diisi',
                "password" => 'Password Instruktur harus diisi',
                "TANGGAL_LAHIR_INSTRUKTUR" => 'Tanggal lahir instruktur Instruktur harus diisi'
            ]);

        $dataInstruktur = $request->all();

        $dataInstruktur["password"] = \bcrypt($request->password);

        $instruktur = Instruktur::create($dataInstruktur);

        if ($instruktur) {
            return redirect()
                ->intended("/instruktur")
                ->with(["success" => "Berhasil menambah Instrukturr"]);
        }
        return redirect()
            ->intended("mainDashboard")
            ->with(["error" => "Gagal menambah Instruktur"]);
    }

    public function update(Request $request, $id) {
        $instruktur = Instruktur::where('ID_INSTRUKTUR',$id)->first();

        $validate = $request->validate(
            [
                "NAMA_INSTRUKTUR" => ["required"],
                "ALAMAT_INSTRUKTUR" => ["required"],
                "NO_TELEPON_INSTRUKTUR" => ["required"],
                "UMUR_INSTRUKTUR" => ["required"],
                "JENIS_KELAMIN_INSTRUKTUR" => ["required"],
                "EMAIL_INSTRUKTUR" => ["required"],
                "password" => ["required"],
                "TANGGAL_LAHIR_INSTRUKTUR" => ["required"],
            ],[
                "NAMA_INSTRUKTUR" => 'Nama Instruktur harus diisi',
                "ALAMAT_INSTRUKTUR" => 'Alamat Instruktur harus diisi',
                "NO_TELEPON_INSTRUKTUR" => 'No telepon Instruktur harus diisi',
                "UMUR_INSTRUKTUR" => 'Umur Instruktur harus diisi',
                "JENIS_KELAMIN_INSTRUKTUR" => 'Jenis kelamin Instruktur harus diisi',
                "EMAIL_INSTRUKTUR" => 'Email Instruktur harus diisi',
                "password" => 'Password Instruktur harus diisi',
                "TANGGAL_LAHIR_INSTRUKTUR" => 'Tanggal lahir instruktur Instruktur harus diisi'

            ]);

        if($request->NAMA_INSTRUKTUR) {
            $instruktur->NAMA_INSTRUKTUR = $request->NAMA_INSTRUKTUR;
        }
        if($request->ALAMAT_INSTRUKTUR){
            $instruktur->ALAMAT_INSTRUKTUR = $request->ALAMAT_INSTRUKTUR;
        }
        if($request->NO_TELEPON_INSTRUKTUR){
            $instruktur->NO_TELEPON_INSTRUKTUR = $request->NO_TELEPON_INSTRUKTUR;
        }
        if($request->UMUR_INSTRUKTUR){
            $instruktur->UMUR_INSTRUKTUR = $request->UMUR_INSTRUKTUR;
        }
        if($request->JENIS_KELAMIN_INSTRUKTUR){
            $instruktur->JENIS_KELAMIN_INSTRUKTUR = $request->JENIS_KELAMIN_INSTRUKTUR;
        }
        if($request->EMAIL_INSTRUKTUR){
            $instruktur->EMAIL_INSTRUKTUR = $request->EMAIL_INSTRUKTUR;
        }
        if($request->password){
            $instruktur->password = \bcrypt ($request->password);
        }
        if($request->TANGGAL_LAHIR_INSTRUKTUR){
            $instruktur->TANGGAL_LAHIR_INSTRUKTUR = $request->TANGGAL_LAHIR_INSTRUKTUR;
        }
        
        $instruktur->update();
        if($instruktur) {
            return redirect()->intended('/instruktur')->with(['success' => 'Berhasil mengubah Instruktur']);
        }
        return redirect()->intended('/dashboard')->with(['error' => 'Gagal mengubah Instruktur']);
    }

    // public function search(Request $request) {
    //     if($request->search != null) {
    //         $instruktur = Instruktur::where('NAMA_INSTRUKTUR',$request->search)->paginate(5);
    //     }
    //     else {
    //         $instruktur = Instruktur::orderby('ID_INSTRUKTUR','desc')->paginate(5);
    //     }
        
    //     return view('/admin/data_instruktur/datainstruktur')->with([
    //         'pegawai' => Auth::guard('pegawai')->user(),
    //         'instruktur' => $instruktur,
    //     ]);
    // }

    public function search(Request $request) {
        $instruktur = Instruktur::where('NAMA_INSTRUKTUR', 'like' , '%'.$request->search.'%')
        ->orWhere('ALAMAT_INSTRUKTUR', 'like' , '%'.$request->search.'%')
        ->orWhere('NO_TELEPON_INSTRUKTUR', 'like' , '%'.$request->search.'%')
        ->orWhere('UMUR_INSTRUKTUR', 'like' , '%'.$request->search.'%')
        ->orWhere('JENIS_KELAMIN_INSTRUKTUR', 'like' , '%'.$request->search.'%')
        ->orWhere('EMAIL_INSTRUKTUR', 'like' , '%'.$request->search.'%')
        ->orWhere('TANGGAL_LAHIR_INSTRUKTUR', 'like' , '%'.$request->search.'%')
        ->orWhere('JUMLAH_TERLAMBAT', 'like' , '%'.$request->search.'%')
        ->paginate(5);
        $instruktur->appends(['search' => $request->search]);
        // if($request->search != null) {
           
        // }
        // else {
        //     $instruktur = Instructor::orderby('ID_INSTRUKTUR','desc')->paginate(5);
        //     // $instruktur->appends(['search' => $request->search]);
        // }
        
        return view('/admin/data_instruktur/datainstruktur')->with([
            'pegawai' => Auth::guard('pegawai')->user(),
            'instruktur' => $instruktur,
        ]);
    }

    public function resetTerlambatPage()
    {
        $instruktur = Instruktur::all();

        return view("admin/data_instruktur/resetTerlambat")->with([
            'pegawai' => Auth::guard('pegawai')->user(),
            'instruktur' => $instruktur
        ]);
    }

    public function resetTerlambat()
    {
        $instruktur = Instruktur::all();

        if ($instruktur) {
            if ($instruktur->first()->TANGGAL_EXPIRED_TERLAMBAT < Carbon::now() || $instruktur->first()->TANGGAL_EXPIRED_TERLAMBAT == null) {
                foreach ($instruktur as $item) {
                    $item->JUMLAH_TERLAMBAT = 0;
                    $item->TANGGAL_EXPIRED_TERLAMBAT = Carbon::now()->addMonths(1);
                    $item->update();
                }
                return redirect()->intended('resetTerlambatPage')->with(['success' => 'Succesfully reset instruktur late. You can reset again on ' . $item->TANGGAL_EXPIRED_TERLAMBAT]);
            } else {

                return redirect()->intended('resetTerlambatPage')->with(['error' => 'Failed reset instruktur late. You can reset again on ' . $instruktur->first()->TANGGAL_EXPIRED_TERLAMBAT]);
            }

        }
        return redirect()->intended('resetTerlambatPage')->with(['error' => 'Failed reset instruktur late']);
    }


    public function getDataInstruktur(Request $request, $id)
    {
        if ($request->expectsjson()) {
            // $dataInstruktur = DB::table("instruktur as i")
            //     ->select(
            //         "i.NAMA_INSTRUKTUR",
            //         "i.EMAIL_INSTRUKTUR",
            //         "i.JENIS_KELAMIN_INSTRUKTUR",
            //         "i.NO_TELPON_INSTRUKTUR",
            //         "pi.WAKTU_TERLAMBAT"
            //     )
            //     ->leftJoin(
            //         "presensi_instruktur as pi",
            //         "i.ID_INSTRUKTUR",
            //         "pi.ID_INSTRUKTUR"
            //     )
            //     ->where("i.ID_INSTRUKTUR", $id)
            //     ->orWhere("pi.ID_INSTRUKTUR", $id)
            //     ->first();

            $dataInstruktur = Instruktur::where("ID_INSTRUKTUR", $id)->first();

            if ($dataInstruktur) {
                return response(
                    [
                        "message" => "Berhasil mengambil data instruktur",
                        "data" => $dataInstruktur,
                    ],
                    200
                );
            }

            return response(
                [
                    "message" => "Instruktur tidak ditemukan",
                    "data" => null,
                ],
                200
            );
        }
    }

    public function getHistoriAktivitasInstruktur(Request $request, $id)
    {
        if ($request->expectsjson()) {
       
            $dataInstruktur = DB::table("instruktur as i")
            ->select(
                "k.NAMA_KELAS",
                "i.NAMA_INSTRUKTUR",
                "k.TARIF",
                "ju.TANGGAL_JADWAL_UMUM",
                "ju.HARI_JADWAL_UMUM",
                "ju.WAKTU_JADWAL_UMUM",
                "pi.JAM_MULAI",
                "pi.JAM_SELESAI"
            )
            ->leftjoin("jadwal_umum as ju", "i.ID_INSTRUKTUR", "=", "ju.ID_INSTRUKTUR")
            ->leftjoin("kelas as k", "ju.ID_KELAS", "=", "k.ID_KELAS")
            ->leftjoin("presensi_instruktur as pi", "ju.ID_KELAS", "=", "pi.ID_INSTRUKTUR")
            ->where("i.ID_INSTRUKTUR", $id)
            ->get();
        

            if ($dataInstruktur) {
                return response(
                    [
                        "message" => "Berhasil mengambil data instruktur",
                        "data" => $dataInstruktur,
                    ],
                    200
                );
            }

            return response(
                [
                    "message" => "Instruktur tidak ditemukan",
                    "data" => null,
                ],
                200
            );
        }
    }
    
}
