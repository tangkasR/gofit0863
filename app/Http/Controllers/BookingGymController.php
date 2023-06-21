<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\BookingGym;
use App\Models\Member;
use App\Models\JadwalHarian;
use App\Models\Jadwal;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingGymController extends Controller
{
    public function index(Request $request){
        if($request->accepts('text/html')){
            $booking_gym = BookingGym::orderBy('KODE_BOOKING_GYM','desc')->where('STATUS_PRESENSI_GYM',null)->get();
            $booking_gym2 = BookingGym::orderBy('KODE_BOOKING_GYM','desc')->where('STATUS_PRESENSI_GYM','!=',null)->get();

            return view('kasir/booking_gym/databookinggym')->with([
                'pegawai' => Auth::guard('pegawai')->user(),
                'booking_gym' => $booking_gym,
                'booking_gym2' => $booking_gym2, 
            ]);            
        }
    }

    public function konfirmasiBookingGym(Request $request,$id){
        if($request->accepts('text/html')){
            $booking = BookingGym::where('KODE_BOOKING_GYM',$id)->first();
            if($booking){
                $booking->WAKTU_PRESENSI = Carbon::now();
                $booking->STATUS_PRESENSI_GYM = 'Hadir';
                $booking->update();
                return redirect()->intended('bookingGym')->with(['success' => 'Berhasil konfirmasi']);
            }
            return redirect()->intended('bookingGym')->with(['error' => 'Gagal konfirmasi']);
        }
    }

    public function cetakStruk($id){
        $strukBookingGym = BookingGym::where('KODE_BOOKING_GYM',$id)->first();
        return view('kasir/booking_gym/strukBookingGym')->with([
            'pegawai' => Auth::guard('pegawai')->user(),
            'strukBookingGym' => $strukBookingGym,
        ]);
    }

    public function indexBookingGym($id)
    {
        $bookingGym = BookingGym::where("ID_MEMBER", $id)->get();

        if ($bookingGym) {
            return response(
                [
                    "message" => "Berhasil mengambil data booking gym",
                    "data" => $bookingGym,
                ],
                200
            );
        }
        return response(
            [
                "message" => "Tidak berhasil mengambil data booking gym",
                "data" => null,
            ],
            200
        );
    }

    public function batalGym($id){
        $booking = BookingGym::where('KODE_BOOKING_GYM',$id)->first();

        if($booking){
            if(Carbon::now()->format('Y-m-d') <= Carbon::parse($booking->TANGGAL_BOOKING_GYM)->subDays(1)){
                $booking->delete();
                return response([
                    'message' => 'Succesfully cancel booking',
                    'data' => $booking,
                ], 200);
            }else {
                return response([
                    'message' => 'You can cancel booking class max h-1 day',
                    'data' => null,
                ], 400); 
            }
        }
        return response([
            'message' => 'Failed cancel booking',
            'data' => null,
        ], 400);
    }

    public function store(Request $request){
        if($request->expectsJson()){
            $validate = Validator::make($request->all(),[
                'ID_MEMBER' => ['required'],
                'SLOT_WAKTU_GYM' => ['required'],
                'TANGGAL_BOOKING_GYM' => ['required'],
            ]);
    
            if($validate->fails()) {
                return response(['success' => false,'message' => $validate->errors()],400);   
            }

            if($request->TANGGAL_BOOKING_GYM <= Carbon::now()->format('Y-m-d')){
                return response([
                    'message' => 'Masukan tanggal boking lebih dari sekarang ',
                    'data' => null,
                ], 400);
            }

            $member = Member::where('ID_MEMBER',$request->ID_MEMBER)->first();

            if($member->MASA_AKTIVASI == null || $member->MASA_AKTIVASI < Carbon::now()){
                return response([
                    'message' => 'Member belum aktivasi',
                    'data' => null,
                ], 400);
            }

            $cekDuplikatKelas = BookingGym::where('ID_MEMBER',$request->ID_MEMBER)->where('TANGGAL_BOOKING_GYM',$request->TANGGAL_BOOKING_GYM)->where('SLOT_WAKTU_GYM',$request->SLOT_WAKTU_GYM)->first();
            if($cekDuplikatKelas) {
                return response([
                    'message' => 'You have been booking this class',
                    'data' => null,
                ], 400);
            }

            $check = BookingGym::where('SLOT_WAKTU_GYM',$request->SLOT_WAKTU_GYM)->where('TANGGAL_BOOKING_GYM',$request->TANGGAL_BOOKING_GYM)->count();

            if($check <= 10){
                $store_data = BookingGym::create([
                    'ID_MEMBER' => $request->ID_MEMBER,
                    'SLOT_WAKTU_GYM' => $request->SLOT_WAKTU_GYM,
                    'STATUS_PRESENSI_GYM' => null,
                    'TANGGAL_BOOKING_GYM' => $request->TANGGAL_BOOKING_GYM,
                    'TANGGAL_MELAKUKAN_BOOKING' => Carbon::now(),
                    'WAKTU_PRESENSI' => null,
                    
                ]);
                
                if($store_data){
                    return response([
                        'message' => 'Succesfully create booking gym',
                        'data' => $store_data,
                        // 'data_depo' => $member_deposit
                    ], 200);
                }else {
                    return response([
                        'message' => 'Failed create store booking gym',
                        'data' => null,
                    ], 400);
                }
            }else {
                return response([
                    'message' => 'Class Gym Full',
                    'data' => null,
                ], 400);
            }
        }
    }

}
