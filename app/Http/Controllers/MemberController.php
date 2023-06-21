<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\MemberDepositKelas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\carbon;

class MemberController extends Controller
{
    public function index(){
        $member = Member::all();

        return view("kasir.data_member.datamember")->with ([
            'pegawai'=> Auth::guard('pegawai')->user(),
            'member'=> $member
        ]);
    }

    public function addPage(){
        return view("kasir.data_member.tambahdata")->with ([
            'pegawai'=> Auth::guard('pegawai')->user()
        ]);
    }
    public function editPage($id){
        $member = Member::find($id);

        return view("kasir.data_member.editdata")->with ([
            'pegawai'=> Auth::guard('pegawai')->user(),
            'member' => $member
        ]);
    }

    public function destroy($id){
        $member = Member::where('ID_MEMBER',$id);
        $member->delete();

        if($member){
            return redirect()->intended('/member');
        }
        return redirect()->intended('/');
    }

    public function store(Request $request)
    {   
        $validate = $request->validate(
            [
                "NAMA_MEMBER" => ["required"],
                "ALAMAT_MEMBER" => ["required"],
                "TELEPON_MEMBER" => ["required"],
                "JENIS_KELAMIN_MEMBER" => ["required"],
                "TANGGAL_LAHIR_MEMBER" => ["required"],
                "EMAIL" => ["required"],
                "password" => ["required"],
            ],[
                'NAMA_MEMBER.required' => 'Nama member harus diisi',
                'ALAMAT_MEMBER.required' => 'Alamat member harus diisi',
                'TELEPON_MEMBER.required' => 'Telepon member harus diisi',
                'JENIS_KELAMIN_MEMBER.required' => 'Jenis kelamin member harus diisi',
                'TANGGAL_LAHIR_MEMBER.required' => 'Tanggal lahir member harus diisi',
                'EMAIL.required' => 'Email harus diisi',
                'password.required' => 'Password harus diisi',

            ]);

        $dataMember = $request->all();

        $dataMember["password"] = \bcrypt($request->password);
        $dataMember["MASA_AKTIVASI"] = null;
        $dataMember["SISA_DEPOSIT_UANG"] = null;
        $dataMember["SISA_DEPOSIT_KELAS"] = null;

        $member = Member::create($dataMember);

        if ($member) {
            return redirect()
                ->intended("/member")
                ->with(["success" => "Berhasil menambah member"]);
        }
        return redirect()
            ->intended("/dashboard")
            ->with(["error" => "Gagal menambah member"]);
    }

    public function update(Request $request, $id) {
        $member = Member::where('ID_MEMBER',$id)->first();

        $validate = $request->validate(
            [
                "NAMA_MEMBER" => ["required"],
                "ALAMAT_MEMBER" => ["required"],
                "TELEPON_MEMBER" => ["required"],
                "JENIS_KELAMIN_MEMBER" => ["required"],
                "TANGGAL_LAHIR_MEMBER" => ["required"],
                "EMAIL" => ["required"],
                "password" => ["required"],
            ],[
                'NAMA_MEMBER.required' => 'Nama member harus diisi',
                'ALAMAT_MEMBER.required' => 'Alamat member harus diisi',
                'TELEPON_MEMBER.required' => 'Telepon member harus diisi',
                'JENIS_KELAMIN_MEMBER.required' => 'Jenis kelamin member harus diisi',
                'TANGGAL_LAHIR_MEMBER.required' => 'Tanggal lahir member harus diisi',
                'EMAIL.required' => 'Email harus diisi',
                'password.required' => 'Password harus diisi',

            ]);
            
        if($request->NAMA_MEMBER) {
            $member->NAMA_MEMBER = $request->NAMA_MEMBER;
        }
        if($request->ALAMAT_MEMBER){
            $member->ALAMAT_MEMBER = $request->ALAMAT_MEMBER;
        }
        if($request->TELEPON_MEMBER){
            $member->TELEPON_MEMBER = $request->TELEPON_MEMBER;
        }
        if($request->JENIS_KELAMIN_MEMBER){
            $member->JENIS_KELAMIN_MEMBER = $request->JENIS_KELAMIN_MEMBER;
        }
        if($request->MASA_AKTIVASI){
            $member->MASA_AKTIVASI = $request->MASA_AKTIVASI;
        }
        if($request->SISA_DEPOSIT_KELAS){
            $member->SISA_DEPOSIT_KELAS = $request->SISA_DEPOSIT_KELAS;
        }
        if($request->SISA_DEPOSIT_UANG){
            $member->SISA_DEPOSIT_UANG = $request->SISA_DEPOSIT_UANG;
        }
        if($request->TANGGAL_LAHIR_MEMBER){
            $member->TANGGAL_LAHIR_MEMBER = $request->TANGGAL_LAHIR_MEMBER;
        }
        if($request->EMAIL){
            $member->EMAIL = $request->EMAIL;
        }
        if($request->password){
            $member->password = \bcrypt ($request->password);
        }
        

        $member->update();
        if($member) {
            return redirect()->intended('/member')->with(['success' => 'Berhasil mengubah member']);
        }
        return redirect()->intended('/dashboard')->with(['error' => 'Gagal mengubah member']);
    }

    // public function search(Request $request) {
    //     if($request->search != null) {
    //         $member = Member::where('NAMA_MEMBER',$request->search);
    //     }
    //     else {
    //         $member = Member::orderby('ID_MEMBER','desc');
    //     }
        
    //     return view('/kasir/data_member/datamember')->with([
    //         'pegawai' => Auth::guard('pegawai')->user(),
    //         'member' => $member,
    //     ]);
    // }

    public function search(Request $request) {
        $member = Member::where('NAMA_MEMBER', 'like','%'.$request->search.'%')
        ->orWhere('ALAMAT_MEMBER', 'like','%'.$request->search.'%')
        ->orWhere('TELEPON_MEMBER', 'like','%'.$request->search.'%')
        ->orWhere('JENIS_KELAMIN_MEMBER', 'like','%'.$request->search.'%')
        ->orWhere('MASA_AKTIVASI', 'like','%'.$request->search.'%')
        ->orWhere('SISA_DEPOSIT_KELAS', 'like','%'.$request->search.'%')
        ->orWhere('SISA_DEPOSIT_UANG', 'like','%'.$request->search.'%')
        ->orWhere('TANGGAL_LAHIR_MEMBER', 'like','%'.$request->search.'%')
        ->orWhere('EMAIL', 'like','%'.$request->search.'%')
        ->paginate(100);
        $member->appends(['search' => $request->search]);
    // if($request->search != null) {
        
    // }
    // else {
    //     $member = Member::orderby('ID_MEMBER','desc')->paginate(5);
    // }
    
    return view('/kasir/data_member/datamember')->with([
        'pegawai' => Auth::guard('pegawai')->user(),
        'member' => $member,
    ]);
}

    public function cardMember($id) {
        $member = member::where('ID_MEMBER',$id)->first();
        return view('kasir.data_member.cardmember')->with([
            'member' => $member,'pegawai' => Auth::guard('pegawai')->user()
        ]);
        // return view('member/member_card');
    }


    public function reset_password($id){
        $member = Member::where('ID_MEMBER',$id)->first();

        $member_update = Member::where('ID_MEMBER', $id)
        ->limit(1) 
        ->update(array('password' => bcrypt($member->TANGGAL_LAHIR_MEMBER))); 

        if($member_update) {
            return redirect()->intended('/member')->with([
                'success' => 'Password berhasil di reset menjadi (yyyy-mm-dd)'
            ]);
        }else {
            return redirect()->intended('/dashboard')->with([
                'success' => 'Password tidak direset'
            ]);
        }
    }



    public function deaktivasiMemberPage(){
        $member = Member::orderby('ID_MEMBER','desc')->where('MASA_AKTIVASI','<',Carbon::now())->get();

        return view("kasir/data_member/deaktivasimember")->with ([
            'pegawai'=> Auth::guard('pegawai')->user(),
            'member'=> $member
        ]);
    }

    // public function deaktivasiMember($id){
    //     $member = Member::where("ID_MEMBER",$id)->first();
    //         if($member && $member->TANGGAL_NONAKTIF < Carbon::now() || $member && $member->TANGGAL_NONAKTIF == null ){
    //             $member->MASA_AKTIVASI = null;
    //             $member->SISA_DEPOSIT_KELAS = 0;
    //             $member->SISA_DEPOSIT_UANG = 0;
    //             $member->MASA_EXPIRED_KELAS = null;
    //             $member->TANGGAL_NONAKTIF = Carbon::now()->addDays(1);
    //             $member->update();
    //             return redirect()->intended('deaktivasiPage')->with(['success' => 'Berhasil menonaktif member']);
    //         }
    //         return redirect()->intended('deaktivasiPage')->with(['error' => 'Gagal menonaktif member']);
    // }

    public function deaktivasiMember(){
        $member = Member::where("MASA_AKTIVASI","<",Carbon::now())->get();
        if($member){     
                foreach($member as $item){
                    $item->MASA_AKTIVASI = null;
                    $item->SISA_DEPOSIT_KELAS = 0;
                    $item->SISA_DEPOSIT_UANG = 0;
                    $item->MASA_EXPIRED_KELAS = null;
                    $item->TANGGAL_NONAKTIF = Carbon::now()->addDays(1);
                    $item->update();
                }
                return redirect()->intended('/deaktivasiPage')->with(['success' => 'Berhasil menonaktif member']);
            

        }
        return redirect()->intended('/deaktivasiPage')->with(['error' => 'Gagal menonaktif member']);
    }

    public function resetKelasMemberPage(){
        $member = MemberDepositKelas::orderby('ID','desc')->where('MASA_BERLAKU','<',Carbon::now())->get();
        $member_after = MemberDepositKelas::orderby('ID','desc')->where('MASA_BERLAKU',null)->get();
        
        return view("kasir/data_member/resetkelasmember")->with ([
            'pegawai' => Auth::guard('pegawai')->user(),
            'member' => $member,
            'member_after' => $member_after
        ]);
    }
    
    public function resetKelasMember(){
    $members = MemberDepositKelas::orderby('ID','desc')->where('MASA_BERLAKU','<',Carbon::now())->get();
        if($members){
            foreach($members as $member){
                if($member->MASA_EXPIRED_RESET < Carbon::now() || $member && $member->MASA_EXPIRED_RESET == null ){
                    $member->SISA_DEPOSIT_KELAS = 0;
                    $member->MASA_BERLAKU = null;
                    $member->MASA_EXPIRED_RESET = Carbon::now()->addDays(1);
                    $member->update();
                }else {
                    return redirect()->intended('resetKelasMemberPage')->with(['error' => 'Gagal mereset kelas']);
                }
            }
            return redirect()->intended('resetKelasMemberPage')->with(['success' => 'Berhasil mereset kelas']);
        }
        return redirect()->intended('resetKelasMemberPage')->with(['error' => 'Gagal mereset kelas']);
    }

    public function getDataMember(Request $request, $id)
    {
        if ($request->expectsjson()) {


            $members = DB::select(
                'SELECT m.ID_MEMBER, m.NAMA_MEMBER, m.EMAIL, m.MASA_AKTIVASI, m.SISA_DEPOSIT_UANG, md.SISA_DEPOSIT_KELAS FROM member m LEFT JOIN member_deposit_kelas md ON m.ID_MEMBER = md.ID_MEMBER  WHERE m.ID_MEMBER = "' .
                    $id .
                    '" GROUP BY m.NAMA_MEMBER, md.SISA_DEPOSIT_KELAS '
            );

            if ($members) {
                return response(
                    [
                        "message" => "Berhasil mengambil data member",
                        "data" => $members,
                    ],
                    200
                );
            }

            return response(
                [
                    "message" => "Member tidak ditemukan",
                    "data" => null,
                ],
                200
            );
        }
    }

    
}
