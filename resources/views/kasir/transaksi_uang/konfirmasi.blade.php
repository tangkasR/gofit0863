@extends('dashboard')
@section('container')
    <div class="" style="display: flex; justify-content: center">
        <div class="card p-3 mt-3" style="width: 50%; height: 50%;">
            <div class="card-body p-3 bg-white">
                <form action="{{ url('/storeUang') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group col-md-12">
                        <p>Id : {{ $member->ID_MEMBER }}</p>
                        <p>Nama : {{ $member->NAMA_MEMBER }}</p>
                    </div>

                    <div class="form-row mb-2">
                        <div class="form-group col-md-6">
                            <input type='text' class="form-control mb-3"name="ID_MEMBER"
                                placeholder="Input date of birth member" autocomplete="off" value="{{ $member->ID_MEMBER }}"
                                hidden />

                            <label class="font-weight-bold mb-2"><b>Jumlah Deposit Uang</b></label>
                            <input type='text' class="form-control mb-3"name="JUMLAH_DEPOSIT"
                                placeholder="Input Deposit Amount" autocomplete="off" value="{{ $jumlah_deposit }}"
                                readonly />

                            <label class="font-weight-bold mb-2">Tanggal Deposit Uang</label>
                            <input type='text' class="form-control mb-3"name="TANGGAL_DEPOSIT_UANG" placeholder=""
                                autocomplete="off" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" disabled />

                            <label class="font-weight-bold mb-2 mt-2"><b>Nominal Uang Pembayaran</b> </label>
                            <input type='text' class="form-control mb-3"name="JUMLAH_UANG"
                                placeholder="Masukan uang pembayaran" autocomplete="off" />
                        </div>
                    </div>

                    @error('JUMLAH_UANG')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    @error('JUMLAH_DEPOSIT')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <a href="{{ url('/transaksiUang') }}" class="btn btn-danger">
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
