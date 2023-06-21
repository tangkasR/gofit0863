<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\TransaksiUang;
use App\Models\Member;
use App\Models\Pegawai;
use App\Models\Promo;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TransaksiUangController extends Controller
{
    public function index() {
        $transaksiUang = TransaksiUang::orderBy('ID_TRANSAKSI_DEPOSIT_UANG','asc')->get();
        $member = Member::where('MASA_AKTIVASI','<',Carbon::now())->orWhere('MASA_AKTIVASI',null)->get();
        $promo = Promo::all();

        return view('kasir/transaksi_uang/datatransaksi')->with([
            'pegawai' => Auth::guard('pegawai')->user(),
            'transaksiUang' => $transaksiUang, 
            'member' => $member,
            'promo' => $promo
        ]);
    }


    public function kuitansi($id){
        $member = member::where('MASA_AKTIVASI','<',Carbon::now())->orWhere('MASA_AKTIVASI',null)->get();
        $transaksiUang = TransaksiUang::where('ID_TRANSAKSI_DEPOSIT_UANG',$id)->first();
        $promo = Promo::where('ID_PROMO',$id)->first();
        return view('kasir/transaksi_uang/kuitansi')->with([
            'transaksiUang' => $transaksiUang,
            'pegawai'=> Auth::guard('pegawai')->user(),
            'member' => $member,
            'promo' => $promo
        ]);
    }

    public function addPage(){
        $member = Member::all();

        return view('kasir/transaksi_uang/tambahdata')->with ([
            'pegawai'=> Auth::guard('pegawai')->user(),
            'member' => $member,
        ]);
    }

    public function konfirmasiUang(Request $request){
        $this->validate($request,[
            'ID_MEMBER' => 'required',
            'JUMLAH_DEPOSIT' => ['required','numeric'],
        ],[
            'ID_MEMBER.required' => 'Member tidak boleh kosong',
            'JUMLAH_DEPOSIT.required' => 'Jumlah Deposit Uang tidak boleh kosong',
            'JUMLAH_DEPOSIT.numeric' => 'Format Jumlah Deposit Uang numerik'
        ]);

        $member_check = member::where('ID_MEMBER',$request->ID_MEMBER)->where('MASA_AKTIVASI','!=',null)->where('MASA_AKTIVASi','>=',Carbon::now())->first();

        if(!($member_check)) {
            return redirect()->intended('/transaksiUang')->with(['error' => 'Member belum melakukan aktivasi']);
        }
        
        $member = member::where('ID_MEMBER',$request->ID_MEMBER)->first();
        

        return view('kasir/transaksi_uang/konfirmasi')->with([
            'pegawai' => Auth::guard('pegawai')->user(),
            'member' => $member,
            'jumlah_deposit' => $request->JUMLAH_DEPOSIT
        ]);
    }

    public function store(Request $request){
        $validate = $request->validate([
            'ID_MEMBER' => ['required'],
            'JUMLAH_DEPOSIT' => ['required','numeric'],
            'JUMLAH_UANG' => ['required']
        ],[
            'ID_MEMBER.required' => 'Member tidak boleh kosong',
            'JUMLAH_DEPOSIT.required' => 'Jumlah Deposit Uang tidak boleh kosong',
            'JUMLAH_DEPOSIT.numeric' => 'Format Jumlah Deposit Uang numerik',
            'JUMLAH_UANG.required' => 'Nominal uang pembayaran tidak boleh kosong'
        ]);

        $member_check = member::where('ID_MEMBER',$request->ID_MEMBER)->where('MASA_AKTIVASI','!=',null)->where('MASA_AKTIVASi','>=',Carbon::now())->first();

        if(!($member_check)) {
            return redirect()->intended('/transaksiUang')->with(['error' => 'Member belum melakukan aktivasi']);
        }
        
        // if($request->JUMLAH_DEPOSIT >= 3000000 && $request->SISA_DEPOSIT >=500000) {
        //     $promo = promo::where('BONUS',300000)->first();
        //     if($promo) {
        //         $idPromo = $promo->ID_PROMO;
        //         $bonus = $promo->BONUS;
        //     }else {
        //         $idPromo = null;
        //         $bonus = 0;
        //     }
        // }else {
        //     $idPromo = null;
        //     $bonus = 0;
        // }
        
        $cek_member = Member::where('ID_MEMBER',$request->ID_MEMBER)->first();
        if($cek_member->SISA_DEPOSIT_UANG) {
            $sisa = $cek_member->SISA_DEPOSIT_UANG;
        }else {
            $sisa = 0;
        }

        if($request->JUMLAH_DEPOSIT >= 3000000 && $cek_member->SISA_DEPOSIT_UANG >=500000) {  
            $promo = Promo::where('BONUS',300000)->first();
            if($promo) {
                $idPromo = $promo->ID_PROMO;
                $bonus = $promo->BONUS;
            }
        }else {
            $idPromo = null;
            $bonus = 0;
        }

        if($request->JUMLAH_UANG < $request->JUMLAH_DEPOSIT){
            return redirect()->back()->with(['error' => 'Nominal uang pembayaran tidak mencukupi']);
        }
        
        $datadepomoney = transaksiUang::create([
            'ID_PROMO' => $idPromo,
            'ID_MEMBER' => $request->ID_MEMBER,
            'ID_PEGAWAI' => Auth::guard('pegawai')->user()->ID_PEGAWAI,
            'JUMLAH_DEPOSIT' => $request->JUMLAH_DEPOSIT,
            'BONUS_DEPOSIT' => $bonus,
            'SISA_DEPOSIT' => $sisa,
            'TOTAL_DEPOSIT' => $request->JUMLAH_DEPOSIT + $sisa + $bonus,
            'TANGGAL_DEPOSIT_UANG' => Carbon::now(),
            'KEMBALIAN' => $request->JUMLAH_UANG - $request->JUMLAH_DEPOSIT
        ]);

        if($datadepomoney){
            $member = member::where('ID_MEMBER',$request->ID_MEMBER)->first();
            $member->SISA_DEPOSIT_UANG = $request->JUMLAH_DEPOSIT + $sisa + $bonus;
            $member->update();
            $data = transaksiUang::latest('ID_TRANSAKSI_DEPOSIT_UANG')->first();
            return redirect()->intended('/kuitansiUang/'.$data->ID_TRANSAKSI_DEPOSIT_UANG);
        }else {
            return redirect()->intended('/transaksiUang')->with(['error' => 'Transaksi gagal']);
        }
    }

    // public function store(Request $request){
    //     $validate = $request->validate([
    //         'ID_MEMBER' => ['required'],
    //         'JUMLAH_DEPOSIT' => ['required','numeric'],
    //     ],[
    //         'ID_MEMBER.required' => 'Nama member tidak boleh kosong',
    //         'JUMLAH_DEPOSIT.required' => 'Nominal uang tidak boleh kosong',
    //         'JUMLAH_DEPOSIT.numeric' => 'Format nominal uang harus numeric'
    //     ]);
    //     $cek_member = Member::where('ID_MEMBER',$request->ID_MEMBER)->first();
    //     if($request->JUMLAH_DEPOSIT >= 3000000 && $cek_member->SISA_DEPOSIT_UANG >=500000) {  
    //         $promo = Promo::where('BONUS',300000)->first();
    //         if($promo) {
    //             $idPromo = $promo->ID_PROMO;
    //             $bonus = $promo->BONUS;
    //         }
    //     }else {
    //         $idPromo = null;
    //         $bonus = 0;
    //     }
        
    //     if($cek_member->SISA_DEPOSIT_UANG) {
    //         $sisa = $cek_member->SISA_DEPOSIT_UANG;
    //     }else {
    //         $sisa = 0;
    //     }
        
    //     $transaksiUang = TransaksiUang::create([
    //         'ID_PROMO' => $idPromo,
    //         'ID_MEMBER' => $request->ID_MEMBER,
    //         'ID_PEGAWAI' => Auth::guard('pegawai')->user()->ID_PEGAWAI,
    //         'JUMLAH_DEPOSIT' => $request->JUMLAH_DEPOSIT,
    //         'BONUS_DEPOSIT' => $bonus,
    //         'SISA_DEPOSIT' => $sisa,
    //         'TOTAL_DEPOSIT' => $request->JUMLAH_DEPOSIT + $sisa + $bonus,
    //         'TANGGAL_DEPOSIT_UANG' => Carbon::now(),
    //     ]);

    //     if($transaksiUang){
    //         $member = Member::where('ID_MEMBER',$request->ID_MEMBER)->first();
    //         $member->SISA_DEPOSIT_UANG = $request->JUMLAH_DEPOSIT + $sisa + $bonus;
    //         $member->update();
    //         $data = TransaksiUang::latest('ID_TRANSAKSI_DEPOSIT_UANG')->first();
    //         return redirect()->intended('/transaksiUang')->with(['success' => 'Deposit uang berhasil']);
    //     }else {
    //         return redirect()->intended('/transaksiUang')->with(['error' => 'Deposit uang gagal']);
    //     }
    // }
}
