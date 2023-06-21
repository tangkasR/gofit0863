<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\TransaksiAktivasi;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TransaksiAktivasiController extends Controller
{
    public function index() {
        $transaksiAktivasi = TransaksiAktivasi::orderBy('ID_TRANSAKSI_AKTIVASI','asc')->get();
        $member = member::where('MASA_AKTIVASI','<',Carbon::now())->orWhere('MASA_AKTIVASI',null)->get();
        
        return view('kasir/transaksi_aktivasi/datatransaksi')->with([
            'pegawai' => Auth::guard('pegawai')->user(),
            'transaksiAktivasi' => $transaksiAktivasi, 
            'member' => $member,
        ]);
    }

    public function addPageAktivasi(){
        $member = Member::where('MASA_AKTIVASI','<',Carbon::now())->orWhere('MASA_AKTIVASI',null)->get();
        return view('kasir/transaksi_aktivasi/tambahdata')->with ([
            'pegawai'=> Auth::guard('pegawai')->user(),
            'member' => $member,
        ]);
    }

    // public function store(Request $request) {

    //     $this->validate($request,[
    //         'ID_MEMBER' => 'required'
    //     ],[
    //         'ID_MEMBER.required' => 'The member field is required'
    //     ]);
        
    //     $member = Member::where('ID_MEMBER',$request->ID_MEMBER)->first();
    //     $pegawai = Auth::guard('pegawai')->user();

    //     if($member) {
    //         $activation_transaction = TransaksiAktivasi::create([
    //             'ID_MEMBER' => $member->ID_MEMBER,
    //             'ID_PEGAWAI' => $pegawai->ID_PEGAWAI,
    //             'TANGGAL_TRANSAKSI_AKTIVASI' => Carbon::now()->format('Y-m-d H:i:s'),
    //             'TANGGAL_EXPIRED_TRANSAKSI_AKTIVASI' => Carbon::now()->addYears(1)->format('Y-m-d H:i:s'),
    //             'BIAYA_AKTIVASI' => 3000000,
    //         ]);
            
    //         if($activation_transaction) {
    //             $member->MASA_AKTIVASI = Carbon::now()->addYears(1)->format('Y-m-d H:i:s');
    //             $member->update();
    //             $data = TransaksiAktivasi::latest('ID_TRANSAKSI_AKTIVASI')->first();
    //             return redirect()->intended('/transaksiAktivasi')->with(['success' => 'Berhasil mengaktivasi member']);
    //         }else {
    //             return redirect()->intended('transaksiAktivasi')->with(['error' => 'Gagal mengaktivasi member']);
    //         }
    //     }else {
    //         return redirect()->intended('transaksiAktivasi')->with(['error' => 'Gagal mengaktivasi member']);
    //     }
    // }

    public function konfirmasiAktivasi(Request $request){
        $this->validate($request,[
            'ID_MEMBER' => 'required'
        ],[
            'ID_MEMBER.required' => 'Member tidak boleh kosong'
        ]);

        $member = member::where('ID_MEMBER',$request->ID_MEMBER)->first();
        
        return view('kasir/transaksi_aktivasi/konfirmasi')->with([
            'pegawai' => Auth::guard('pegawai')->user(),
            'member' => $member,
        ]);
    }

    public function store(Request $request) {

        $this->validate($request,[
            'ID_MEMBER' => 'required',
            'JUMLAH_UANG' => 'required',
        ],[
            'ID_MEMBER.required' => 'Member tidak boleh kosong',
            'JUMLAH_UANG.required' => 'Nominal pembayaran tidak boleh kosong'
        ]);
        
        $member = member::where('ID_MEMBER',$request->ID_MEMBER)->first();
        $pegawai = Auth::guard('pegawai')->user();

        if($request->JUMLAH_UANG < 3000000){
            return redirect()->back()->with(['error' => 'Nominal Uang Pembayaran Kurang']);
        }
        
        if($member) {
            $activation_transaction = transaksiAktivasi::create([
                'ID_MEMBER' => $member->ID_MEMBER,
                'ID_PEGAWAI' => $pegawai->ID_PEGAWAI,
                'TANGGAL_TRANSAKSI_AKTIVASI' => Carbon::now()->format('Y-m-d H:i:s'),
                'TANGGAL_EXPIRED_TRANSAKSI_AKTIVASI' => Carbon::now()->addYears(1)->format('Y-m-d H:i:s'),
                'BIAYA_AKTIVASI' => 3000000,
                'STATUS_PEMBAYARAN' => "Lunas",
                'KEMBALIAN' => $request->JUMLAH_UANG - 3000000
            ]);
            
            if($activation_transaction) {
                $member->MASA_AKTIVASI = Carbon::now()->addYears(1)->format('Y-m-d H:i:s');
                $member->update();
                $data = transaksiAktivasi::latest('ID_TRANSAKSI_AKTIVASI')->first();
                return redirect()->intended('/kuitansi/'.$data->ID_TRANSAKSI_AKTIVASI);
            }else {
                return redirect()->intended('/transaksiAktivasi')->with(['error' => 'Failed activate member']);
            }
        }else {
            return redirect()->intended('/transaksiAktivasi')->with(['error' => 'Failed activate member']);
        }
    }

    public function kuitansi($id){
        $member = member::where('MASA_AKTIVASI','<',Carbon::now())->orWhere('MASA_AKTIVASI',null)->get();
        $transaksiAktivasi = TransaksiAktivasi::where('ID_TRANSAKSI_AKTIVASI',$id)->first();
        return view('kasir/transaksi_aktivasi/kuitansi')->with([
            'transaksiAktivasi' => $transaksiAktivasi,
            'pegawai'=> Auth::guard('pegawai')->user(),
            'member' => $member
        ]);
    }
}
