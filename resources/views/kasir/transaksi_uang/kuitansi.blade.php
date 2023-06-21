@extends('dashboard')
@section('container')
    <div class="card p-3 mt-3" style="width: 50%; height: 50%;">
        <div class="card-body p-3 bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <h5>GoFit</h5>
                <div>
                    No Struk: {{ $transaksiUang->ID_TRANSAKSI_DEPOSIT_UANG }}
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                Jl. Centralpark No. 10 Yogyakarta
                <div>
                    Tanggal: {{ $transaksiUang->TANGGAL_DEPOSIT_UANG }}
                </div>
            </div>
            <div class="mt-2">
                <h5>Member : {{ $transaksiUang->ID_MEMBER }} / {{ $transaksiUang->member->NAMA_MEMBER }}</h5>
            </div>
            <div>
                Deposit : {{ $transaksiUang->JUMLAH_DEPOSIT }}
            </div>
            <div>
                Bonus Deposit : {{ $transaksiUang->BONUS_DEPOSIT }}
            </div>
            <div>
                Total Deposit : {{ $transaksiUang->TOTAL_DEPOSIT }}
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <div></div>
                Kasir: {{ $transaksiUang->ID_PEGAWAI }} / {{ $transaksiUang->pegawai->NAMA_PEGAWAI }}
            </div>
            <script type="text/javascript">
                window.print();
            </script>
        </div>

    </div>
@endsection
