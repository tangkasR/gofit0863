@extends('dashboard')
@section('container')
    <div class="p-2" style="margin-left:-10%;width:112%;background-color: #ABD9FF">
        <h1 style="margin-left: 10%;color:#ECF9FF">Data Booking Kelas</h1>
    </div>
    <div class="table-responsive mt-3">
        <table class="table table-striped table-sm">
            <thead style="background-color:#99E1E5;color:#FFFBEB">

                <div class="mt-2">
                    <tr class="text-center">
                        <th scope="col">Kode Booking Kelas</th>
                        <th scope="col">Id Member</th>
                        <th scope="col">Tanggal Jadwal Harian</th>
                        <th scope="col">Status Presensi Kelas</th>
                        <th scope="col">Tarif Kelas</th>
                        <th scope="col">Waktu Presensi Kelas</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </div>
            </thead>
            <tbody style="background-color:#ECF9FF">
                @foreach ($booking as $item)
                    <tr>
                        <td class="text-center">{{ $item->KODE_BOOKING_KELAS }}</td>
                        <td class="text-center">{{ $item->ID_MEMBER }}</td>
                        <td class="text-center">{{ $item->TANGGAL_JADWAL_HARIAN }}</td>
                        <td class="text-center">{{ $item->STATUS_PRESENSI_KELAS }}</td>
                        <td class="text-center">{{ $item->TARIF_KELAS }}</td>
                        <td class="text-center">{{ $item->WAKTU_PRESENSI_KELAS }}</td>
                        <td class="text-center">
                            <a style="color:#FFFBEB" class='btn btn-info btn-xs'
                                href="{{ url('/cetakStrukBookingKelas/' . $item->KODE_BOOKING_KELAS) }}">
                                <span class="glyphicon glyphicon-edit"></span> Cetak Struk
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
