@extends('dashboard')
@section('container')
    <div class="p-2" style="margin-left:-10%;width:112%;background-color: #ABD9FF">
        <h1 style="margin-left: 10%;color:#ECF9FF">Data Transaksi Deposit Uang</h1>
    </div>

    <div class="mt-3">
        <a href="{{ url('/addPageTransaksiUang') }}" class="btn shadow rounded"
            style="background-color: #3AB4F2;color:#FFFBEB"><b>+</b>
            Tambah Transaksi Deposit Uang</a>
    </div>

    <div class="table-responsive mt-3">
        <table class="table table-striped table-sm">
            <thead style="background-color:#99E1E5;color:#FFFBEB">
                <div class="mt-2">
                    <tr class="text-center">
                        <th scope="col">Id Transaksi Deposit Uang</th>
                        <th scope="col">Nama Member</th>
                        <th scope="col">Nama Pegawai</th>
                        <th scope="col">Jenis Promo</th>
                        <th scope="col">Tanggal Deposit Uang</th>
                        <th scope="col">Jumlah Deposit</th>
                        <th scope="col">Bonus Deposit</th>
                        <th scope="col">Total Deposit</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </div>
            </thead>
            <tbody style="background-color:#ECF9FF">
                @foreach ($transaksiUang as $item)
                    <tr class="text-center">
                        <td>{{ $item->ID_TRANSAKSI_DEPOSIT_UANG }}</td>
                        <td>{{ $item->member->NAMA_MEMBER }}</td>
                        <td>{{ $item->pegawai->NAMA_PEGAWAI }}</td>
                        @if ($item->ID_PROMO != null)
                            <td>{{ $item->promo->JENIS_PROMO }}</td>
                        @else
                            <td>-</td>
                        @endif
                        <td>{{ $item->TANGGAL_DEPOSIT_UANG }}</td>
                        <td>{{ $item->JUMLAH_DEPOSIT }}</td>
                        <td>{{ $item->BONUS_DEPOSIT }}</td>
                        <td>{{ $item->TOTAL_DEPOSIT }}</td>
                        <td>
                            <a style="color:#FFFBEB" class='btn btn-info btn-xs'
                                href="{{ url('/kuitansiUang/' . $item->ID_TRANSAKSI_DEPOSIT_UANG) }}">
                                <span class="glyphicon glyphicon-edit"></span> Cetak Kuitansi
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
