@extends('dashboard')
@section('container')
    <div class="" style="display: flex; justify-content: center">
        <div class="card p-3 mt-3 " style="width: 50%; height: 50%;">
            <div class="card-body p-3 bg-white">
                <form action="{{ url('/storeAktivasi') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group col-md-12">
                        <p>Id : {{ $member->ID_MEMBER }}</p>
                        <p>Nama : {{ $member->NAMA_MEMBER }}</p>
                        <p>Status: Tidak Aktif</p>
                    </div>
                    <div class="form-row mb-2">
                        <div class="form-group col-md-6">
                            <input type='text' class="form-control mb-3"name="ID_MEMBER"
                                placeholder="Input date of birth member" autocomplete="off" value="{{ $member->ID_MEMBER }}"
                                hidden />
                            <label class="font-weight-bold mb-2"><b>Tanggal Expired Aktivasi</b></label>
                            <input type='text' class="form-control mb-3"name="TANGGAL_EXPIRED_TRANSAKSI_AKTIVASI"
                                placeholder="Input date of birth member" autocomplete="off"
                                value="{{ Carbon\Carbon::now()->addYears(1)->format('Y-m-d') }}" disabled />

                            <label class="font-weight-bold mb-2">Tanggal Transaksi Aktivasi</label>
                            <input type='text' class="form-control mb-3"name="TANGGAL_TRANSAKSI_AKTIVASI" placeholder=""
                                autocomplete="off" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" disabled />

                            <label class="font-weight-bold mb-2">Total Pembayaran</label>
                            <input type='text' class="form-control mb-3"name="BIAYA" placeholder="" autocomplete="off"
                                value="Rp.3000000" disabled />

                            <label class="font-weight-bold mb-2 mt-2"><b>Nominal Uang Pembayaran</b> </label>
                            <input type='text' class="form-control mb-3"name="JUMLAH_UANG"
                                placeholder="Masukan uang pembayaran" autocomplete="off" />
                        </div>
                    </div>
                    <a href="{{ url('/transaksiAktivasi') }}" class="btn btn-danger">
                        Batal
                    </a>
                    <button class="btn btn-primary" type="submit">
                        Bayar
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
