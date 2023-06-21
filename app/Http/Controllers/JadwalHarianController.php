<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Jadwal;
use App\Models\Instruktur;
use App\Models\JadwalHarian;
use App\Models\Kelas;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class JadwalHarianController extends Controller
{
    // public function index(){
    //     $jadwalHarian = JadwalHarian::orderBy('TANGGAL_JADWAL_HARIAN','asc')->get();
    //     $tgljadwalHarian = JadwalHarian::first();

    //     return view("mo/jadwal_harian/datajadwal")->with ([
    //         'pegawai'=> Auth::guard('pegawai')->user(),
    //         'jadwalHarian'=> $jadwalHarian,
    //         'tanggal' => $tgljadwalHarian
    //     ]);
    // }

    // public function generateJadwal(){
    //     $jadwal = Jadwal::all();
    //     $jadwalHarian = JadwalHarian::first();

    //     $generate = JadwalHarian::where('expired', '>=' ,Carbon::now())->first();

    //     if(JadwalHarian::exists() || $generate) {
    //         return redirect()->intended('/jadwalHarian')->with(['error' => 'Jadwal Harian sudah digenerate pada '. $jadwalHarian->expired]);
    //     }else {
    //         // JadwalHarian::truncate();
            
    //         for($i=Carbon::now();$i<=Carbon::now()->addDays(6);$i->modify('+1 day')){
    //             $day = Carbon::createFromFormat('Y-m-d H:i:s', $i)->translatedformat('l');
    //             foreach($jadwal as $item){
    //                 if($day == $item->HARI_JADWAL_UMUM){
    //                     $hari = JadwalHarian::create([
    //                         'TANGGAL_JADWAL_HARIAN' => $i->format('Y-m-d').' '.$item->WAKTU_JADWAL_UMUM,
    //                         'ID_INSTRUKTUR' => $item->ID_INSTRUKTUR,
    //                         'ID_JADWAL_UMUM' => $item->ID_JADWAL_UMUM,
    //                         'STATUS_JADWAL_HARIAN' => '-',
    //                         'expired' => Carbon::now()->addDays(6)->format('Y-m-d H:i:s'),
    //                     ]);
    //                 }
    //             }
    //         }
    //         return redirect()->intended('/jadwalHarian')->with(['success' => 'Berhasil men-generate jadwal harian']);
    //     }   
    // }

    public function index(){
        $jadwalHarian = JadwalHarian::where('expired','>=',Carbon::now()->format('Y-m-d'))->orderBy('TANGGAL_JADWAL_HARIAN','asc')->get();
        // $tgljadwalHarian = JadwalHarian::first();
        $tgljadwalHarian = JadwalHarian::where('expired','>=',Carbon::now()->format('Y-m-d'))->first();

        return view("mo/jadwal_harian/datajadwal")->with ([
            'pegawai' => Auth::guard('pegawai')->user(),
            'jadwalHarian' => $jadwalHarian,
            'tanggal' => $tgljadwalHarian,
        ]);
    }

    public function generateJadwal(){
        $jadwal = Jadwal::all();
        // $tgljadwalHarian = JadwalHarian::where('expired','>=',Carbon::now())->first();

        $generate = JadwalHarian::where('expired', '>=' ,Carbon::now()->format('Y-m-d'))->latest('expired')->first();

        if($generate) {
            return redirect()->intended('jadwalHarian')->with(['error' => 'Jadwal Harian sudah digenerate, dapat generate lagi pada '. $generate->expired ]);
        }else {
            // JadwalHarian::truncate();
            $expired = Carbon::now()->addDays(6)->format('Y-m-d H:i:s');
            for($i=Carbon::now();$i<=Carbon::now()->addDays(6);$i->modify('+1 day')){
                $day = Carbon::createFromFormat('Y-m-d H:i:s', $i)->translatedformat('l');
                foreach($jadwal as $item){
                    if($day == $item->HARI_JADWAL_UMUM){
                        $hari = JadwalHarian::create([
                            'TANGGAL_JADWAL_HARIAN' => $i->format('Y-m-d').' '.$item->WAKTU_JADWAL_UMUM,
                            'ID_INSTRUKTUR' => $item->ID_INSTRUKTUR,
                            'ID_JADWAL_UMUM' => $item->ID_JADWAL_UMUM,
                            'STATUS_JADWAL_HARIAN' => '-',
                            'expired' => $expired,
                        ]);
                    }
                }
            }
            return redirect()->intended('jadwalHarian')->with(['success' => 'Berhasil men-generate jadwal harian']);
        }
    }

    public function editPage($id){
        $jadwalHarian = jadwalHarian::where('TANGGAL_JADWAL_HARIAN',$id)->first();
        $instruktur = instruktur::all();

        return view('mo/jadwal_harian/editdata')->with([
            'pegawai' => Auth::guard('pegawai')->user(),
            'jadwalHarian' => $jadwalHarian,
            'instruktur' => $instruktur
        ]);
    }

    public function update(Request $request,$id) {
        $jadwalHarian = jadwalHarian::where('TANGGAL_JADWAL_HARIAN',$id)->first();
        
        if($request->ID_INSTRUKTUR){
            $jadwalHarian->ID_INSTRUKTUR = $request->ID_INSTRUKTUR;
        }
        if($request->STATUS_JADWAL_HARIAN) {
            $jadwalHarian->STATUS_JADWAL_HARIAN = $request->STATUS_JADWAL_HARIAN;
        }
        $jadwalHarianNew = $jadwalHarian->update();
        
        if($jadwalHarianNew) {
            return redirect()->intended('/jadwalHarian')->with(['success' => 'Berhasil mengubah jadwal harian']);
        }
        return redirect()->intended('/jadwalHarian')->with(['error' => 'Gagal mengubah jadwal harian']);
        
    }

    // public function search(Request $request){
    //     $tanggal = JadwalHarian::first();
    //     if($request->search != null) {
    //         $instruktur = Instruktur::where('NAMA_INSTRUKTUR',$request->search)->first();
    //         $kelas = Kelas::where('NAMA_KELAS',$request->search)->first();
    //         if($instruktur) {
    //             $jadwalHarian = JadwalHarian::where('ID_INSTRUKTUR',$instruktur->ID_INSTRUKTUR)->get();
    //         }else if($kelas){
    //             $jadwal = Jadwal::where('ID_KELAS',$kelas->ID_KELAS)->first();
    //             $jadwalHarian = JadwalHarian::where('ID_JADWAL_UMUM',$jadwal->ID_JADWAL_UMUM)->get();
    //         }else {
    //             $jadwalHarian = JadwalHarian::where('TANGGAL_JADWAL_HARIAN',$request->search)->orWhere('STATUS_JADWAL_HARIAN',$request->search)->get();
    //         }
    //     }
    //     else {
    //         $jadwalHarian = JadwalHarian::orderby('TANGGAL_JADWAL_HARIAN','asc')->get();
    //     }
        
    //     return view('mo/jadwal_harian/datajadwal')->with([
    //         'pegawai' => Auth::guard('pegawai')->user(),
    //         'jadwalHarian' => $jadwalHarian,
    //         'tanggal' => $tanggal
    //     ]);
    // }
    
    public function search(Request $request){
        // $tanggal = JadwalHarian::where('expired','<=',Carbon::now());
        $tanggal = JadwalHarian::where('expired','>=',Carbon::now())->first();
        if($request->search != null) {
            $instruktur = Instruktur::where('NAMA_INSTRUKTUR',$request->search)->first();
            $kelas = Kelas::where('NAMA_KELAS',$request->search)->first();
            if($instruktur) {
                // $jadwalHarian = JadwalHarian::where('TANGGAL_JADWAL_HARIAN',$request->search)->orWhere('ID_INSTRUKTUR',$instruktur->ID_INSTRUKTUR)->orWhere('ID_JADWAL_UMUM',$jadwal->ID_JADWAL_UMUM)->orWhere('STATUS_JADWAL_HARIAN',$request->search);
                $jadwalHarian = JadwalHarian::where('ID_INSTRUKTUR',$instruktur->ID_INSTRUKTUR)->where('expired',$tanggal->expired)->get();
            }
            else if($kelas){
                //MASIH AMBIGU
                $jadwal = Jadwal::where('ID_KELAS',$kelas->ID_KELAS)->get();
                $jadwalHarian = JadwalHarian::whereIn('ID_JADWAL_UMUM',$jadwal->pluck('ID_JADWAL_UMUM'))->where('expired',$tanggal->expired)->get();
                // $jadwalHarian = DB::select('SELECT * from jadwal_harian jh 
                // join jadwal_umum ju ON (jh.ID_JADWAL_UMUM = ju.ID_JADWAL_UMUM) 
                // join kelas k on (ju.ID_KELAS = k.ID_KELAS)
                // where k.NAMA_KELAS LIKE "%'.$kelas->NAMA_KELAS.'%"
                // ');
            }else {
                $jadwalHarian = JadwalHarian::where('TANGGAL_JADWAL_HARIAN','like','%'.$request->search.'%')
                ->where('expired',$tanggal->expired)
                ->orWhere('STATUS_JADWAL_HARIAN','like','%'.$request->search.'%')
                ->where('expired',$tanggal->expired)
                ->get();
            }
        }
        else {
            $jadwalHarian = JadwalHarian::orderby('TANGGAL_JADWAL_HARIAN','asc')->where('expired',$tanggal->expired)->get();
        }
        
        return view('mo/jadwal_harian/datajadwal')->with([
            'pegawai' => Auth::guard('pegawai')->user(),
            'jadwalHarian' => $jadwalHarian,
            'tanggal' => $tanggal
        ]);
    }


    public function indexApi(Request $request){
        if($request->expectsjson()){
            $jadwalHarian = DB::table('jadwal_harian as jh')
            ->select('jh.TANGGAL_JADWAL_HARIAN','i.NAMA_INSTRUKTUR','k.NAMA_KELAS','ju.ID_KELAS','jh.STATUS_JADWAL_HARIAN','ju.HARI_JADWAL_UMUM', 'k.TARIF')
            ->join('instruktur as i','jh.ID_INSTRUKTUR','i.ID_INSTRUKTUR')
            ->join('jadwal_umum as ju','jh.ID_JADWAL_UMUM','ju.ID_JADWAL_UMUM')
            ->join('kelas as k','ju.ID_KELAS','k.ID_KELAS')
            ->where('jh.TANGGAL_JADWAL_HARIAN', '>', Carbon::now())
            ->orderby('jh.TANGGAL_JADWAL_HARIAN','asc')->get();
            if($jadwalHarian){
                return response([
                    'message' => 'Successfully get data schedule',
                    'data' => $jadwalHarian,
                ],200);
            }
            return response([
                'message' => 'Successfully get data permission',
                'data' => null,
            ],400);
        }
    }
}
