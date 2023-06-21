@extends('dashboard')
@section('container')
    <div class="card p-3 mt-3" style="width: 50%; height: 50%;">
        <div class="card-body p-3 bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <h5>GoFit</h5>
                <div>
                    No Struk: {{ $transaksiKelas->ID_TRANSAKSI_PAKET }}
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                Jl. Centralpark No. 10 Yogyakarta
                <div>
                    Tanggal: {{ $transaksiKelas->TANGGAL_DEPOSIT_KELAS }}
                </div>
            </div>
            <div class="mt-2">
                <h5>Member : {{ $transaksiKelas->ID_MEMBER }} / {{ $transaksiKelas->member->NAMA_MEMBER }}</h5>
            </div>
            <div>
                Deposit : {{ $transaksiKelas->JUMLAH_PEMBAYARAN }}
            </div>
            <div>
                Jenis Kelas : {{ $transaksiKelas->kelas->NAMA_KELAS }}
            </div>
            <div>
                Masa Berlaku : {{ $transaksiKelas->MASA_BERLAKU_KELAS }}
            </div>
            <div>
                Total Deposit {{ $transaksiKelas->kelas->NAMA_KELAS }} : {{ $transaksiKelas->JUMLAH_DEPOSIT_KELAS }}
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <div></div>
                Kasir: {{ $transaksiKelas->ID_PEGAWAI }} / {{ $transaksiKelas->pegawai->NAMA_PEGAWAI }}
            </div>
            <script type="text/javascript">
                window.print();
            </script>
        </div>

    </div>
@endsection
