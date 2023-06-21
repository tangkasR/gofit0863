@extends('dashboard')
@section('container')
    <div class="p-2" style="margin-left:-10%;width:112%;background-color: #ABD9FF">
        <h1 style="margin-left: 10%;color:#ECF9FF">Data Booking GYM</h1>
        <h5 style="margin-left: 10%;color:#ECF9FF">Tabel Sebelum Konfirmasi Booking GYM</h5>
    </div>
    <div class="table-responsive mt-3">
        <table class="table table-striped table-sm">
            <thead style="background-color:#99E1E5;color:#FFFBEB">

                <div class="mt-2">
                    <tr class="text-center">
                        <th scope="col">Kode Booking Gym</th>
                        <th scope="col">Id Member</th>
                        <th scope="col">Slot Waktu Gym</th>
                        <th scope="col">Status Presensi Gym</th>
                        <th scope="col">Tanggal Booking Gym</th>
                        <th scope="col">Tanggal Melakukan Booking</th>
                        <th scope="col">Waktu Presensi Gym</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </div>
            </thead>
            <tbody style="background-color:#ECF9FF">
                @foreach ($booking_gym as $item)
                    <tr>
                        <td class="text-center">{{ $item->KODE_BOOKING_GYM }}</td>
                        <td class="text-center">{{ $item->ID_MEMBER }}</td>
                        <td class="text-center">{{ $item->SLOT_WAKTU_GYM }}</td>
                        <td class="text-center">{{ $item->STATUS_PRESENSI_GYM }}</td>
                        <td class="text-center">{{ $item->TANGGAL_BOOKING_GYM }}</td>
                        <td class="text-center">{{ $item->TANGGAL_MELAKUKAN_BOOKING }}</td>
                        <td class="text-center">{{ $item->WAKTU_PRESENSI }}</td>
                        <td class="text-center">
                            <a style="color:#FFFBEB" class='btn btn-info btn-xs'
                                href="{{ url('/konfirmasiBookingGym/' . $item->KODE_BOOKING_GYM) }}">
                                <span class="glyphicon glyphicon-edit"></span> Konfirmasi
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="p-2 mt-5" style="margin-left:-10%;width:112%;background-color: #ABD9FF">
        <h5 style="margin-left: 10%;color:#ECF9FF">Tabel Setelah Konfirmasi Booking GYM</h5>
    </div>

    <div class="table-responsive mt-3">
        <table class="table table-striped table-sm">
            <thead style="background-color:#99E1E5;color:#FFFBEB">

                <div class="mt-2">
                    <tr class="text-center">
                        <th scope="col">Kode Booking Gym</th>
                        <th scope="col">Id Member</th>
                        <th scope="col">Slot Waktu Gym</th>
                        <th scope="col">Status Presensi Gym</th>
                        <th scope="col">Tanggal Booking Gym</th>
                        <th scope="col">Tanggal Melakukan Booking</th>
                        <th scope="col">Waktu Presensi Gym</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </div>
            </thead>
            <tbody style="background-color:#ECF9FF">
                @foreach ($booking_gym2 as $item)
                    <tr>
                        <td class="text-center">{{ $item->KODE_BOOKING_GYM }}</td>
                        <td class="text-center">{{ $item->ID_MEMBER }}</td>
                        <td class="text-center">{{ $item->SLOT_WAKTU_GYM }}</td>
                        <td class="text-center">{{ $item->STATUS_PRESENSI_GYM }}</td>
                        <td class="text-center">{{ $item->TANGGAL_BOOKING_GYM }}</td>
                        <td class="text-center">{{ $item->TANGGAL_MELAKUKAN_BOOKING }}</td>
                        <td class="text-center">{{ $item->WAKTU_PRESENSI }}</td>
                        <td class="text-center">
                            <a style="color:#FFFBEB" class='btn btn-info btn-xs'
                                href="{{ url('/cetakStrukBookingGym/' . $item->KODE_BOOKING_GYM) }}">
                                <span class="glyphicon glyphicon-edit"></span> Cetak Struk
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
