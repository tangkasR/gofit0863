@extends('dashboard')
@section('container')
    <div class="p-2" style="margin-left:-10%;width:112%;background-color: #ABD9FF">
        <h1 style="margin-left: 10%;color:#ECF9FF">Data Transaksi Aktivasi</h1>
    </div>

    <div class="mt-3">
        <a href="{{ url('/addPageAktivasi') }}" class="btn shadow rounded"
            style="background-color: #3AB4F2;color:#FFFBEB"><b>+</b>
            Tambah Transaksi Aktivasi</a>
    </div>

    <div class="table-responsive mt-3">
        <table class="table table-striped table-sm">
            <thead style="background-color:#99E1E5;color:#FFFBEB">

                <div class="mt-2">
                    <tr class="text-center">
                        <th scope="col">Id Transaksi Aktivasi</th>
                        <th scope="col">Nama Member</th>
                        <th scope="col">Nama Pegawai</th>
                        <th scope="col">Tanggal Transaksi</th>
                        <th scope="col">Tanggal Kadaluarsa</th>
                        <th scope="col">Biaya Aktivasi</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </div>
            </thead>
            <tbody style="background-color:#ECF9FF">
                @foreach ($transaksiAktivasi as $item)
                    <tr>
                        <td class="text-center">{{ $item->ID_TRANSAKSI_AKTIVASI }}</td>
                        <td class="text-center">{{ $item->member->NAMA_MEMBER }}</td>
                        <td class="text-center">{{ $item->pegawai->NAMA_PEGAWAI }}</td>
                        <td class="text-center">{{ $item->TANGGAL_TRANSAKSI_AKTIVASI }}</td>
                        <td class="text-center">{{ $item->TANGGAL_EXPIRED_TRANSAKSI_AKTIVASI }}</td>
                        <td class="text-center">{{ $item->BIAYA_AKTIVASI }}</td>
                        <td class="text-center">
                            <a style="color:#FFFBEB" class='btn btn-info btn-xs'
                                href="{{ url('/kuitansi/' . $item->ID_TRANSAKSI_AKTIVASI) }}">
                                <span class="glyphicon glyphicon-edit"></span> Cetak Kuitansi
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
