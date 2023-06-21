<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Jadwal;
use App\Models\Instruktur;
use App\Models\Kelas;

class JadwalController extends Controller
{
    
    public function index() {
        // $kelas = Kelas::all();
        $jadwal = Jadwal::orderby('WAKTU_JADWAL_UMUM','asc')->get();

        return view('mo/data_jadwal/datajadwal')->with([
            'pegawai' => Auth::guard('pegawai')->user(),
            // 'kelas' => $kelas,
            'jadwal' => $jadwal
        ]);
    }

    public function addPage(){
        $kelas = Kelas::all();
        $instruktur = Instruktur::all();
        return view('mo.data_jadwal.tambahdata')->with([
            'pegawai' => Auth::guard('pegawai')->user(),
            'kelas' => $kelas,
            'instruktur' => $instruktur
        ]);
    }

    public function store(Request $request){
        $validate = $request->validate([
            'ID_KELAS' => ['required'],
            'ID_INSTRUKTUR' => ['required'],
            'HARI_JADWAL_UMUM' => ['required'],
            'WAKTU_JADWAL_UMUM' => ['required','date_format:H:i:s'],
        ],[
            'ID_KELAS.required' => 'Kelas tidak boleh kosong',
            'ID_INSTRUKTUR.required' => 'Instruktur tidak boleh kosong',
            'HARI_JADWAL_UMUM' => 'Hari jadwal umum tidak boleh kosong',
            'WAKTU_JADWAL_UMUM' => 'Waktu jadwal umum tidak boleh kosong'
        ]);

        $datajadwal = $request->all();

        $cekjadwal = Jadwal::where('ID_INSTRUKTUR',$request->ID_INSTRUKTUR)->where('HARI_JADWAL_UMUM',$request->HARI_JADWAL_UMUM)->where('WAKTU_JADWAL_UMUM',$request->WAKTU_JADWAL_UMUM)->first();

        if($cekjadwal) {
            return redirect()->intended('/jadwal')->with(['error' => 'Jadwal Instruktur bertabrakan dengan yang sudah ada']);
        }else {
            $jadwal = Jadwal::create($datajadwal);

            if($jadwal) {
                return redirect()->intended('/jadwal')->with(['success' => 'Berhasil menambah jadwal umum']);
            }
            return redirect()->intended('/dashboard')->with(['error' => 'Gagal menambah jadwal umum']);
        }
    }


    public function editPage($id){
        $jadwal = Jadwal::where('ID_JADWAL_UMUM',$id)->first();
        $kelas = Kelas::all();
        $instruktur = Instruktur::all();

        return view('mo/data_jadwal/editdata')->with([
            'pegawai' => Auth::guard('pegawai')->user(),
            'jadwal' => $jadwal,
            'kelas' => $kelas,
            'instruktur' => $instruktur
        ]);
    }

    public function update(Request $request,$id) {
        $jadwal = Jadwal::find($id);
        $temp = Jadwal::find($id);

        $validate = $request->validate([
            'ID_KELAS' => ['required'],
            'ID_INSTRUKTUR' => ['required'],
            'HARI_JADWAL_UMUM' => ['required'],
            'WAKTU_JADWAL_UMUM' => ['required','date_format:H:i:s'],
        ],[
            'ID_KELAS.required' => 'Kelas tidak boleh kosong',
            'ID_INSTRUKTUR.required' => 'Instruktur tidak boleh kosong',
            'HARI_JADWAL_UMUM' => 'Hari jadwal umum tidak boleh kosong',
            'WAKTU_JADWAL_UMUM' => 'Waktu jadwal umum tidak boleh kosong'
        ]);


        if($request->ID_KELAS != $temp->ID_KELAS && $request->ID_INSTRUKTUR == $temp->ID_INSTRUKTUR && $request->HARI_JADWAL_UMUM == $temp->HARI_JADWAL_UMUM && $request->WAKTU_JADWAL_UMUM == $temp->WAKTU_JADWAL_UMUM) {
            $jadwal->ID_KELAS = $request->ID_KELAS;
            $jadwal->update();
            if($jadwal) {
                return redirect()->intended('/jadwal')->with(['success' => 'Berhasil mengubah jadwal']);
            }
            return redirect()->intended('jadwal'.$id)->with(['error' => 'Gagal mengubah jadwal']);
        }
        if($request->ID_INSTRUKTUR){
            $jadwal->ID_INSTRUKTUR = $request->ID_INSTRUKTUR;
        }
        if($request->HARI_JADWAL_UMUM){
            $jadwal->HARI_JADWAL_UMUM = $request->HARI_JADWAL_UMUM;
        }
        if($request->WAKTU_JADWAL_UMUM){
            $jadwal->WAKTU_JADWAL_UMUM = $request->WAKTU_JADWAL_UMUM;
        }
        
        $schedule_check = Jadwal::where('ID_INSTRUKTUR',$request->ID_INSTRUKTUR)->where('HARI_JADWAL_UMUM',$request->HARI_JADWAL_UMUM)->where('WAKTU_JADWAL_UMUM',$request->WAKTU_JADWAL_UMUM)->first();

        if($schedule_check) {
            return redirect()->intended('/editPageJadwal'.$id)->with(['error' =>'Instruktur has been scheduled']);
        }else {
            $jadwal->ID_KELAS = $request->ID_KELAS;
            $jadwal_update = $jadwal->update();

            if($jadwal_update) {
                return redirect()->intended('/jadwal')->with(['success' => 'Successfully update jadwal']);
            }
            return redirect()->intended('/editPageJadwal'.$id)->with(['error' => 'Failed update jadwal']);
        }
        
    }

    public function destroy($id) {
        $jadwal = Jadwal::find($id);

        $jadwal->delete();

        if($jadwal) {
            return redirect()->intended('/jadwal')->with([
                'success' => 'Schedule has been successfully deleted'
            ]);
        }else {
            return redirect()->intended('/jadwal')->with([
                'error' => 'Schedule not deleted successfully'
            ]);
        }
    }
}
