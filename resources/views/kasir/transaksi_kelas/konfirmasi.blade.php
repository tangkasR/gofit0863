@extends('dashboard')
@section('container')
    <div class="" style="display: flex; justify-content: center">
        <div class="card p-3 mt-3" style="width: 50%; height: 50%;">
            <div class="card-body p-3 bg-white">
                <form action="{{ url('/storeKelas') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group col-md-12">
                        <p>Id : {{ $member->ID_MEMBER }}</p>
                        <p>Nama : {{ $member->NAMA_MEMBER }}</p>
                        <p>Nama Kelas : {{ $NAMA_KELAS }}</p>

                    </div>

                    <div class="form-row mb-2">
                        <div class="form-group col-md-6">
                            <input type='text' class="form-control mb-3"name="ID_MEMBER"
                                placeholder="Input date of birth member" autocomplete="off" value="{{ $member->ID_MEMBER }}"
                                hidden />

                            <input type='text' class="form-control mb-3"name="ID_KELAS"
                                placeholder="Input date of birth member" autocomplete="off" value="{{ $ID_KELAS }}"
                                hidden />

                            <label class="font-weight-bold mb-2"><b>Jumlah Deposit Kelas</b></label>
                            <input type='number' class="form-control mb-3"name="JUMLAH_DEPOSIT_KELAS"
                                placeholder="Input Deposit Amount" autocomplete="off" value="{{ $JUMLAH_DEPOSIT_KELAS }}"
                                readonly />

                            <label class="font-weight-bold mb-2">Tanggal Deposit Kelas</label>
                            <input type='text' class="form-control mb-3"name="TANGGAL_DEPOSIT_KELAS" placeholder=""
                                autocomplete="off" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" disabled />

                            <label class="font-weight-bold mb-2">Total Pembayaran</label>
                            <input type='text' class="form-control mb-3"name="BIAYA" placeholder="" autocomplete="off"
                                value="{{ $BIAYA }}" disabled />

                            <label class="font-weight-bold mb-2 mt-2"><b>Nominal Uang Pembayaran</b> </label>
                            <input type='text' class="form-control mb-3"name="JUMLAH_UANG"
                                placeholder="Masukan uang pembayaran" autocomplete="off" />
                        </div>
                    </div>
                    <a href="{{ url('/transaksiKelas') }}" class="btn btn-danger">
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
