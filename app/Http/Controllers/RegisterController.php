<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;

class RegisterController extends Controller
{
    public function index(){
        return view('registrasi');
    }

    public function store(Request $request){
     
        $validatedData = $request->validate([
            'NAMA_PEGAWAI'=>'required',
            'ALAMAT_PEGAWAI'=>'required',
            'EMAIL_PEGAWAI'=>'required',
            'PASSWORD_PEGAWAI'=>'required',
            'ROLE_PEGAWAI'=>'required',
            'JENIS_KELAMIN_PEGAWAI'=>'required',
            'UMUR_PEGAWAI'=>'required'
        ]);

        Pegawai::create($validatedData);
    }
}
