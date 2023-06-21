@extends('dashboard')
@section('container')
    <div class="card p-3 mt-3" style="width: 50%; height: 50%;">
        <div class="card-body p-3 bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <h5>GoFit</h5>
                <div>
                    No Struk: {{ $transaksiAktivasi->ID_TRANSAKSI_AKTIVASI }}
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                Jl. Centralpark No. 10 Yogyakarta
                <div>
                    Tanggal: {{ $transaksiAktivasi->TANGGAL_EXPIRED_TRANSAKSI_AKTIVASI }}
                </div>
            </div>
            <div class="mt-2">
                <h5>Member : {{ $transaksiAktivasi->ID_MEMBER }} / {{ $transaksiAktivasi->member->NAMA_MEMBER }}</h5>
            </div>
            <div>
                Aktivasi Tahunan : {{ $transaksiAktivasi->BIAYA_AKTIVASI }}
            </div>
            <div>
                Masa Aktif Member : {{ $transaksiAktivasi->TANGGAL_TRANSAKSI_AKTIVASI }}
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <div></div>
                Kasir: {{ $transaksiAktivasi->ID_PEGAWAI }} / {{ $transaksiAktivasi->pegawai->NAMA_PEGAWAI }}
            </div>
            <script type="text/javascript">
                window.print();
            </script>
        </div>
    </div>
@endsection
