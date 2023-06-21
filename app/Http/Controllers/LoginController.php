<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Pegawai;
use App\Models\Member;
use App\Models\Instruktur;
use Illuminate\Support\Facades\Hash;
 

class LoginController extends Controller
{
    public function index() {
        // if($pegawai = Auth::guard('pegawai')->user()) {
        //     return redirect()->intended('dashboard');
        // }
        return view('login');
    }

    public function login(Request $request) {
        if($request->accepts('text/html')) {
            $validate = $request->validate([
                'EMAIL_PEGAWAI' => ['required','email:rfc,dns'],
                'password' => ['required'],
            ],[
                'EMAIL_PEGAWAI.required' => 'Email tidak boleh kosong',
                'EMAIL_PEGAWAI.email' => 'Email menggunakan format @',
                'password' => 'Password tidak boleh kosong',
            ]);

            $credential = $request->only('EMAIL_PEGAWAI','password');

            if(Auth::guard('pegawai')->attempt($credential)) {
                $request->session()->regenerate();
                $user = Auth::guard('pegawai')->user();
                // if($pegawai->ROLE_PEGAWAI == 'Manajer Operasional') {
                //     return redirect()->intended('beranda')->with('success','Berhasil Login');
                // }
                // if($pegawai->ROLE_PEGAWAI == 'Kasir') {
                //     return redirect()->intended('kasir')->with('success','Berhasil Login');
                // }
                // if($pegawai->ROLE_PEGAWAI == 'Admin') {
                //     return redirect()->intended('admin')->with('success','Berhasil Login');
                // }
                if ($user) {
                    return redirect()->intended('dashboard')->with('success','Berhasil login');
                }
                // return redirect()->intended('/');
                // return view('welcome');
            }
            return redirect()->intended('/')->with('error','Email atau password salah');
        }else{

            $data = $request->only("Email", "password");
            $credentials = Validator::make(
                $data,
                [
                    "Email" => ["required", "email:rfc,dns"],
                    "password" => ["required"],
                ],
                [
                    "Email.required" => "The email field is required",
                    "Email.email" => "Email using format @",
                    "password" => "The password field is required",
                ]
            );

            if ($credentials->fails()) {
                return response(
                    ["success" => false, "message" => $credentials->errors()],
                    400
                );
            }

            $cekPegawai = Pegawai::where("EMAIL_PEGAWAI", $request->Email)
                ->where("ROLE_PEGAWAI", "manager operational")
                ->first();
            $cekMember = Member::where(
                "EMAIL",
                $request->Email
            )->first();
            $cekInstruktur = Instruktur::where(
                "EMAIL_INSTRUKTUR",
                $request->Email
            )->first();

            if (
                $cekPegawai &&
                Hash::check($request->password, $cekPegawai->password)
            ) {
                if (
                    Auth::guard("pegawai")->attempt([
                        "EMAIL_PEGAWAI" => $request->Email,
                        "password" => $request->password,
                    ])
                ) {
                    $pegawai = Auth::guard("pegawai")->user();
                    $token = $pegawai->createToken("Authentication Token")
                        ->accessToken;
                    return response(
                        [
                            "message" => "Authenticated",
                            "user" => $pegawai,
                            "token_type" => "Bearer",
                            "access_token" => $token,
                        ],
                        200
                    );
                }
                return response(
                    [
                        "message" => "Invalid Credentials",
                        "user" => null,
                    ],
                    400
                );
            } elseif (
                $cekMember &&
                Hash::check($request->password, $cekMember->password)
            ) {
                if (
                    Auth::guard("member")->attempt([
                        "EMAIL" => $request->Email,
                        "password" => $request->password,
                    ])
                ) {
                    $member = Auth::guard("member")->user();
                    $token = $member->createToken("Authentication Token")
                        ->accessToken;
                    return response(
                        [
                            "message" => "Authenticated",
                            "user" => $member,
                            "token_type" => "Bearer",
                            "access_token" => $token,
                        ],
                        200
                    );
                }
                return response(
                    [
                        "message" => "Invalid Credentials",
                        "user" => null,
                    ],
                    400
                );
            } elseif (
                $cekInstruktur &&
                Hash::check($request->password, $cekInstruktur->password)
            ) {
                if (
                    Auth::guard("instruktur")->attempt([
                        "EMAIL_INSTRUKTUR" => $request->Email,
                        "password" => $request->password,
                    ])
                ) {
                    $instruktur = Auth::guard("instruktur")->user();
                    $token = $instruktur->createToken("Authentication Token")
                        ->accessToken;
                    return response(
                        [
                            "message" => "Authenticated",
                            "user" => $instruktur,
                            "token_type" => "Bearer",
                            "access_token" => $token,
                        ],
                        200
                    );
                }
                return response(
                    [
                        "message" => "Invalid Credentials",
                        "user" => null,
                    ],
                    400
                );
            } else {
                return response(
                    [
                        "message" => "Invalid Credentials",
                        "user" => null,
                    ],
                    400
                );
            }



        }
    
    }


    public function logout(Request $request){
        if($request->accepts('text/html')) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            return redirect('/')->with('success','You have successfully logged out');
        }else {
            // $pegawai = Auth::logout();
            // $request->session()->invalidate();
            // $request->session()->regenerateToken();
            // $user = Auth::guard('pegawai')->logout();
            $user = Auth::user()->token();
            $user->revoke();
    
            // // return response()->json([
            // //     'message' => 'Logout Success',
            // // ], 200);
            
            // return new pegawaiResource(true, 'Logout Sukses', $user);
            // $user = Auth::guard('pegawai')->user()->tokens();
            

            return response()->json([
                'message' => 'Logout Success',
                'user' => $user
            ], 200);
        }
       
    }

    public function ubahPassword(Request $request)
    {
        $data = $request->only("Email", "password");
        $credentials = Validator::make(
            $data,
            [
                "Email" => ["required", "email:rfc,dns"],
                "password" => ["required"],
            ],
            [
                "Email.required" => "The email field is required",
                "Email.email" => "Email using format @",
                "password" => "The password field is required",
            ]
        );

        if ($credentials->fails()) {
            return response(
                ["success" => false, "message" => $credentials->errors()],
                400
            );
        }
        $pegawai_exists = Pegawai::where("EMAIL_PEGAWAI", $request->Email)
            ->where("ROLE_PEGAWAI", "manager operational")
            ->first();
        $member_exists = Member::where(
            "EMAIL",
            $request->Email
        )->first();
        $instructor_exists = Instruktur::where(
            "EMAIL_INSTRUKTUR",
            $request->Email
        )->first();

        if ($member_exists) {
            return response(
                [
                    "message" =>
                        "Member tidak boleh ganti password. Tolong Kontak Kasir",
                    "user" => null,
                ],
                400
            );
        } elseif ($pegawai_exists) {
            $pegawai_exists->password = \bcrypt($request->password);
            $pegawai_exists->update();
            return response(
                [
                    "message" => "Berhasil mengganti password pegawai",
                    "user" => $pegawai_exists,
                ],
                200
            );
        } elseif ($instructor_exists) {
            $instructor_exists->password = \bcrypt($request->password);
            $instructor_exists->update();
            return response(
                [
                    "message" => "Berhasil mengganti password instruktur",
                    "user" => $instructor_exists,
                ],
                200
            );
        }
        return response(
            [
                "message" =>
                    "User tidak berhasil ditemukan, Tolong masukkan data yang benar",
                "user" => null,
            ],
            400
        );
    }

    // public function storeForgotPassword(Request $request)
    // {
    //     return redirect()
    //         ->intended("forgotPassword")
    //         ->with(["error" => "Mohon maaf, Email tidak tersedia"]);
    // }

    // public function indexGantiPassword()
    // {
    //     return view("gantiPassword")->with([
    //         "pegawai" => Auth::guard("pegawai")->user(),
    //     ]);
    // }

    // public function storeForgotPassword(Request $request)
    // {
    //     $validate = $request->validate([
    //         "EMAIL_PEGAWAI" => ["required"],
    //     ]);

    //     $pegawai = Pegawai::where(
    //         "EMAIL_PEGAWAI",
    //         $request->EMAIL_PEGAWAI
    //     )->first();

    //     if ($pegawai) {
    //         return view("resetPassword")->with([
    //             "user" => Auth::guard("pegawai")->user(),
    //             "pegawai" => $pegawai,
    //         ]);
    //     }
    //     return redirect()
    //         ->intended("forgotPassword")
    //         ->with(["error" => "Mohon maaf, Email tidak tersedia"]);
    // }
    // public function ubahPasswordPegawai(Request $request, $id)
    // {
        
    //     $validate = $request->validate([
    //         "EMAIL_PEGAWAI" => ["required"],
    //         "password" => ["required"],
    //     ]);

    //     $cekPegawai = Pegawai::where("ID_PEGAWAI", $id)->first();

    //     if ($request->password) {
    //         $cekPegawai->password = \bcrypt($request->password);
    //     }

    //     $pegawaiUpdate = Pegawai::where("ID_PEGAWAI", $id)
    //         ->limit(1)
    //         ->update([
    //             "password" => $cekPegawai->password,
    //         ]);

    //     if ($pegawaiUpdate) {
    //         return redirect()
    //             ->intended("login")
    //             ->with(["success" => "Berhasil mengubah data pegawai"]);
    //     }
    // }

    public function indexGantiPassword(){
        return view('gantiPassword')->with([
            'pegawai' => null,
        ]);
    }

    public function ubahPasswordPegawai(Request $request) {

        if($request->accepts('text/html')) {
            $validate = Validator::make($request->all(),[
                'email' => ['required'],
                'password' => ['required'],
                'repassword' => ['required'],
            ],[
                'email.required' => 'Email tidak boleh kosong',
                'password.required' => 'Password tidak boleh kosong',
                'repassword.required' => 'Repassword tidak boleh kosong'
            ]);
    
            $pegawai = Pegawai::where('EMAIL_PEGAWAI', $request->email)->first();
    
            if($validate->fails()) {
                return redirect()->back()->withErrors($validate)->with([
                    'pegawai' => $pegawai
                ]);
            }
            if($pegawai) {
                if($request->password == $request->repassword){
                    $pegawai->password = \bcrypt($request->password);
                    $pegawai->update();
                    return redirect()->intended('/')->with([
                        'success' => 'Berhasil mengubah password'
                    ]);
                }else {
                    return redirect()->intended('/indexGantiPassword')->with([
                        'error' => 'Repassword tidak sama',
                        'pegawai' => $pegawai
                    ]);
                }
            }else {
                return redirect()->intended('/indexGantiPassword')->with([
                    'error' => 'Email tidak ditemukan',
                    'pegawai' => null
                ]);
            }
        } 
    }

   
}
