@extends('dashboard')
@section('container')
    <div class="d-flex align-items-center justify-content-center mt-4" style="width:90%; heigh:50%">
        <div class="card" style="width: 70%">
            <div class="card-header-addPage py-4" style="background-color: #73D2F3">
                <h2 class="text-center">Tambah Data Transaksi Kelas</h2>
            </div>
            <form action="{{ url('/konfirmasiKelas') }}" method="get" enctype="multipart/form-data">
                <div class="card-body p-3" style="background-color: #9FE8FA">
                    <div class="mt-3 mb-3">
                        <div class="d-flex align-items-center justify-content-evenly">
                            <div class="col-md-4">
                                <label for="" class="form-label">Pilih Member</label>
                                <select class="form-control" aria-label="Default select example" name="ID_MEMBER">
                                    <option value="" hidden>Pilih Member</option>
                                    @if ($member->first() != null)
                                        @foreach ($member as $item)
                                            @if ($item->MASA_AKTIVASI != null)
                                                <option value="{{ $item->ID_MEMBER }}">
                                                    {{ $item->NAMA_MEMBER }}</option>
                                            @endif
                                        @endforeach
                                    @else
                                        <option value=""disabled>...</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="" class="form-label">Pilih Kelas</label>
                                <select class="form-control" aria-label="Default select example" name="ID_KELAS">
                                    <option value="" hidden>Pilih Kelas</option>
                                    @if ($kelas->first() != null)
                                        @foreach ($kelas as $item)
                                            <option value="{{ $item->ID_KELAS }}">
                                                {{ $item->NAMA_KELAS }}</option>
                                        @endforeach
                                    @else
                                        <option value=""disabled>...</option>
                                    @endif
                                </select>
                            </div>

                        </div>
                        <div class="d-flex align-items-center justify-content-evenly mt-3">
                            <div class="col-md-4">
                                <label for="" class="form-label">Pilih Paket</label>
                                <select class="form-control mb-3" aria-label="Default select example"
                                    name="JUMLAH_DEPOSIT_KELAS">
                                    <option value="" hidden>Pilih Paket</option>
                                    <option value="5">5 Kelas</option>
                                    <option value="10">10 Kelas</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer text-muted p-4" style="background-color: #73D2F3">
                    <div class="d-flex align-items-center justify-content-center">
                        <a class="btn btn-dark" href="{{ url('/transaksiKelas') }}">
                            Batal
                        </a>
                        <button type="submit" class="btn btn-primary ms-3" style="color:#FFFBEB">
                            Konfirmasi
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
