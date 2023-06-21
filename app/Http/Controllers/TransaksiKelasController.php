<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiKelas;
use App\Models\Member;
use App\Models\Pegawai;
use App\Models\MemberDepositKelas;
use App\Models\Kelas;
use App\Models\Promo;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TransaksiKelasController extends Controller
{
    public function index() {
        $transaksiKelas = TransaksiKelas::orderBy('ID_TRANSAKSI_PAKET','asc')->get();
        $member = Member::where('MASA_AKTIVASI','<',Carbon::now())->orWhere('MASA_AKTIVASI',null)->get();
        $promo = Promo::all();
        $kelas = Kelas::all();

        return view('kasir/transaksi_kelas/datatransaksi')->with([
            'pegawai' => Auth::guard('pegawai')->user(),
            'transaksiKelas' => $transaksiKelas, 
            'member' => $member,
            'promo' => $promo,
            'kelas' => $kelas
        ]);
    }

    public function kuitansi($id){
        $member = member::where('ID_MEMBER',$id)->first();
        $transaksiKelas = TransaksiKelas::where('ID_TRANSAKSI_PAKET',$id)->first();
        $promo = Promo::where('ID_PROMO',$id)->first();
        $kelas = Kelas::where('ID_KELAS', $id)->first();
        return view('kasir/transaksi_kelas/kuitansi')->with([
            'transaksiKelas' => $transaksiKelas,
            'pegawai'=> Auth::guard('pegawai')->user(),
            'member' => $member,
            'promo' => $promo,
            'kelas' => $kelas
        ]);
    }

    public function addPage(){
        $member = Member::all();
        $kelas = Kelas::all();

        return view('kasir/transaksi_kelas/tambahdata')->with ([
            'pegawai'=> Auth::guard('pegawai')->user(),
            'member' => $member,
            'kelas' => $kelas,
        ]);
    }

    public function konfirmasiKelas(Request $request){
        $this->validate($request,[
            'ID_MEMBER' => ['required'],
            'ID_KELAS' => ['required'],
            'JUMLAH_DEPOSIT_KELAS' => ['required','numeric'],
        ],[
            'ID_MEMBER.required' => 'Member tidak boleh kosong',
            'ID_KELAS.required' => 'Kelas tidak boleh kosong',
            'JUMLAH_DEPOSIT_KELAS.required' => 'Paket tidak boleh kosong',
            'JUMLAH_DEPOSIT_KELAS.numeric' => 'Format paket kelas numerik'
        ]);

        $member = member::where('ID_MEMBER',$request->ID_MEMBER)->first();
        $kelas = kelas::where('ID_KELAS',$request->ID_KELAS)->first();
        
        $member_deposit_kelas = MemberDepositKelas::where('ID_MEMBER',$request->ID_MEMBER)->where('ID_KELAS',$request->ID_KELAS)->first();
        if($member_deposit_kelas){
            if($member_deposit_kelas->MASA_BERLAKU < Carbon::now() && $member_deposit_kelas->SISA_DEPOSIT_KELAS != 0 || $member_deposit_kelas->MASA_BERLAKU > Carbon::now() && $member_deposit_kelas->SISA_DEPOSIT_KELAS == 0 || $member_deposit_kelas->MASA_BERLAKU < Carbon::now() && $member_deposit_kelas->SISA_DEPOSIT_KELAS == 0) {
               
            }else {
                return redirect()->intended('/transaksiKelas')->with(['error' => 'Member tidak bisa transaksi sebelum melewati masa berlaku atau sisa deposit kelas 0']);
            }
        }

        return view('kasir/transaksi_kelas/konfirmasi')->with([
            'pegawai' => Auth::guard('pegawai')->user(),
            'member' => $member,
            'ID_KELAS' => $request->ID_KELAS,
            'NAMA_KELAS' => $kelas->NAMA_KELAS,
            'JUMLAH_DEPOSIT_KELAS' => $request->JUMLAH_DEPOSIT_KELAS,
            'BIAYA' => $request->JUMLAH_DEPOSIT_KELAS * $kelas->TARIF
        ]);
    }

    public function store(Request $request){
        $validate = $request->validate([
            'ID_MEMBER' => ['required'],
            'ID_KELAS' => ['required'],
            'JUMLAH_DEPOSIT_KELAS' => ['required','numeric'],
            'JUMLAH_UANG' => ['required']
        ],[
            'ID_MEMBER.required' => 'Member tidak boleh kosong',
            'ID_KELAS.required' => 'Kelas tidak boleh kosong',
            'JUMLAH_DEPOSIT_KELAS.required' => 'Paket tidak boleh kosong',
            'JUMLAH_DEPOSIT_KELAS.numeric' => 'Format paket kelas numerik',
            'JUMLAH_UANG.required' => 'Nominal uang pembayaran tidak boleh kosong'
        ]);

        $datadepoclass = TransaksiKelas::where('ID_MEMBER',$request->ID_MEMBER)->orderby('ID_TRANSAKSI_PAKET','desc')->first();
        
        $member_check_activate = member::where('ID_MEMBER',$request->ID_MEMBER)->where('MASA_AKTIVASI','!=',null)->where('MASA_AKTIVASi','>=',Carbon::now())->first();
        if(!($member_check_activate)) {
            return redirect()->intended('/transaksiKelas')->with(['error' => 'Member not activated. Please activate first']);
        }

        // $member_deposit = memberDepositKelas::where('ID_MEMBER',$request->ID_MEMBER)->where('ID_KELAS',$request->ID_KELAS)->first();
        // if($member_deposit){
        //     if($member_deposit->MASA_BERLAKU < Carbon::now() && $member_deposit->SISA_DEPOSIT_KELAS != 0 || 
        //     $member_deposit->MASA_BERLAKU > Carbon::now() && $member_deposit->SISA_DEPOSIT_KELAS == 0 || 
        //     $member_deposit->MASA_BERLAKU < Carbon::now() && $member_deposit->SISA_DEPOSIT_KELAS == 0) {
        //         $member_deposit->SISA_DEPOSIT_KELAS = 0;
        //         $member_deposit->MASA_BERLAKU = null;
        //         $member_deposit->update();
        //     }else {
        //         return redirect()->intended('/transaksiKelas')->with(['error' => 'Member tidak bisa transaksi sebelum melewati masa berlaku atau sisa deposit kelas 0']);
        //     }
        // }

        
        if($request->JUMLAH_DEPOSIT_KELAS == 5 || $request->JUMLAH_DEPOSIT_KELAS == 10 ) {
            $promo = promo::where('MINIMAL_PEMBELIAN',$request->JUMLAH_DEPOSIT_KELAS)->first();
            if($promo) {
                if($promo->MINIMAL_PEMBELIAN == 5) {
                    $month = 1;
                }else {
                    $month=2;
                }
                $idPromo = $promo->ID_PROMO;
                $bonus = $promo->BONUS;
            }else {
                $idPromo = null;
                $bonus = 0;
            }
        }else {
            $idPromo = null;
            $bonus = 0;
        }

        $kelas = kelas::where('ID_KELAS',$request->ID_KELAS)->first();

        if($request->JUMLAH_UANG < ($kelas->TARIF * $request->JUMLAH_DEPOSIT_KELAS)){
            return redirect()->back()->with(['error' => 'Nominal uang yang dimasukan tidak mencukupi']);
        }

        $datadepoclass = TransaksiKelas::create([
            'ID_MEMBER' => $request->ID_MEMBER,
            'ID_PROMO' => $idPromo,
            'ID_PEGAWAI' => Auth::guard('pegawai')->user()->ID_PEGAWAI,
            'ID_KELAS' => $request->ID_KELAS,
            'JUMLAH_DEPOSIT_KELAS'=> $request->JUMLAH_DEPOSIT_KELAS,
            'TANGGAL_DEPOSIT_KELAS' => Carbon::now(),
            'BONUS_DEPOSIT_KELAS' => $bonus,
            'TOTAL_DEPOSIT_KELAS' => $request->JUMLAH_DEPOSIT_KELAS + $bonus,
            'JUMLAH_PEMBAYARAN'=> $kelas->TARIF * $request->JUMLAH_DEPOSIT_KELAS,
            'MASA_BERLAKU_KELAS' => Carbon::now()->addMonths($month),
            'KEMBALIAN' => $request->JUMLAH_UANG - ($kelas->TARIF * $request->JUMLAH_DEPOSIT_KELAS)
        ]);

        if($datadepoclass){
            $member_deposit2 = memberDepositKelas::where('ID_MEMBER',$request->ID_MEMBER)->where('ID_KELAS',$request->ID_KELAS)->first();

            if($member_deposit2){
                $member_deposit2->SISA_DEPOSIT_KELAS = $request->JUMLAH_DEPOSIT_KELAS + $bonus;
                $member_deposit2->MASA_BERLAKU = Carbon::now()->addMonths($month);
                $member_deposit2->update();
            }else {
                $member_deposit_create = memberDepositKelas::create([
                    'ID_MEMBER'=>$request->ID_MEMBER,
                    'ID_KELAS'=> $request->ID_KELAS,
                    'SISA_DEPOSIT_KELAS'=> $request->JUMLAH_DEPOSIT_KELAS + $bonus,
                    'MASA_BERLAKU'=> Carbon::now()->addMonths($month),
                ]);
            }

            $data = TransaksiKelas::latest('ID_TRANSAKSI_PAKET')->first();

            return redirect()->intended('/kuitansiKelas/'.$data->ID_TRANSAKSI_PAKET);
            
        }else {
            return redirect()->intended('/transaksiKelas')->with(['error' => 'Transaksi gagal']);
        }
    }


    // public function store(Request $request){
    //     $validate = $request->validate([
    //         'ID_MEMBER' => ['required'],
    //         'ID_KELAS' => ['required'],
    //         'JUMLAH_DEPOSIT_KELAS' => ['required','numeric'],
    //     ],[
    //         'ID_MEMBER.required' => 'Nama member harus diisi',
    //         'ID_KELAS.required' => 'Nama kelas harus diisi',
    //         'JUMLAH_DEPOSIT_KELAS.required' => 'Jumlah paket harus diisi'
    //     ]);

    //     $transaksiKelas = TransaksiKelas::where('ID_MEMBER',$request->ID_MEMBER)->orderby('ID_TRANSAKSI_PAKET','desc')->first();
        
    //     $cekAktivasiMember = Member::where('ID_MEMBER',$request->ID_MEMBER)->where('MASA_AKTIVASI','!=',null)->where('MASA_AKTIVASi','>=',Carbon::now())->first();
    //     if(!($cekAktivasiMember)) {
    //         return redirect()->intended('/transaksiKelas')->with(['error' => 'Member Tidak Aktif']);
    //     }

    //     $member_deposit_kelas = MemberDepositKelas::where('ID_MEMBER',$request->ID_MEMBER)->where('ID_KELAS',$request->ID_KELAS)->first();
    //     if($member_deposit_kelas){
    //         if($member_deposit_kelas->MASA_BERLAKU < Carbon::now() && $member_deposit_kelas->SISA_DEPOSIT_KELAS != 0 || $member_deposit_kelas->MASA_BERLAKU > Carbon::now() && $member_deposit_kelas->SISA_DEPOSIT_KELAS == 0 || $member_deposit_kelas->MASA_BERLAKU < Carbon::now() && $member_deposit_kelas->SISA_DEPOSIT_KELAS == 0) {
    //             $member_deposit_kelas->SISA_DEPOSIT_KELAS = 0;
    //             $member_deposit_kelas->MASA_BERLAKU = null;
    //             $member_deposit_kelas->update();
    //         }else {
    //             return redirect()->intended('/transaksiKelas')->with(['error' => 'Member tidak bisa transaksi sebelum melewati masa berlaku atau sisa deposit kelas 0']);
    //         }
    //     }

        
    //     if($request->JUMLAH_DEPOSIT_KELAS == 5 || $request->JUMLAH_DEPOSIT_KELAS == 10 ) {
    //         $promo = Promo::where('MINIMAL_PEMBELIAN',$request->JUMLAH_DEPOSIT_KELAS)->first();
    //         if($promo) {
    //             if($promo->MINIMAL_PEMBELIAN == 5) {
    //                 $month = 1;
    //             }else {
    //                 $month=2;
    //             }
    //             $idPromo = $promo->ID_PROMO;
    //             $bonus = $promo->BONUS;
    //         }else {
    //             $idPromo = null;
    //             $bonus = 0;
    //         }
    //     }else {
    //         $idPromo = null;
    //         $bonus = 0;
    //     }

    //     $kelas = Kelas::where('ID_KELAS',$request->ID_KELAS)->first();

    //     $transaksiKelas = TransaksiKelas::create([
    //         'ID_MEMBER' => $request->ID_MEMBER,
    //         'ID_PROMO' => $idPromo,
    //         'ID_PEGAWAI' => Auth::guard('pegawai')->user()->ID_PEGAWAI,
    //         'ID_KELAS' => $request->ID_KELAS,
    //         'JUMLAH_DEPOSIT_KELAS'=> $request->JUMLAH_DEPOSIT_KELAS,
    //         'TANGGAL_DEPOSIT_KELAS' => Carbon::now(),
    //         'BONUS_DEPOSIT_KELAS' => $bonus,
    //         'TOTAL_DEPOSIT_KELAS' => $request->JUMLAH_DEPOSIT_KELAS + $bonus,
    //         'JUMLAH_PEMBAYARAN'=> $kelas->TARIF * $request->JUMLAH_DEPOSIT_KELAS,
    //         'MASA_BERLAKU_KELAS' => Carbon::now()->addMonths($month),
    //     ]);

    //     if($transaksiKelas){
    //         $member_deposit2 = MemberDepositKelas::where('ID_MEMBER',$request->ID_MEMBER)->where('ID_KELAS',$request->ID_KELAS)->first();

    //         if($member_deposit2){
    //             $member_deposit2->SISA_DEPOSIT_KELAS = $request->JUMLAH_DEPOSIT_KELAS + $bonus;
    //             $member_deposit2->MASA_BERLAKU = Carbon::now()->addMonths($month);
    //             $member_deposit2->update();
    //         } else {
    //             $member_deposit_create = MemberDepositKelas::create([
    //                 'ID_MEMBER'=>$request->ID_MEMBER,
    //                 'ID_KELAS'=> $request->ID_KELAS,
    //                 'SISA_DEPOSIT_KELAS'=> $request->JUMLAH_DEPOSIT_KELAS + $bonus,
    //                 'MASA_BERLAKU'=> Carbon::now()->addMonths($month),
    //             ]);
    //         }
            
    //         $data = TransaksiKelas::latest('ID_TRANSAKSI_PAKET')->first();
    //         return redirect()->intended('/transaksiKelas')->with(['success' => 'Berhasil transaksi']);
    //     } else {
    //         return redirect()->intended('/transaksiKelas')->with(['error' => 'Gagal transaksi']);
    //     }
    // }
}
