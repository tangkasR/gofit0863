@extends('dashboard')
@section('container')
    <div class="d-flex align-items-center justify-content-center mt-4" style="width:90%; heigh:50%">
        <div class="card" style="width: 70%">
            <div class="card-header-addPage py-4" style="background-color: #73D2F3">
                <h2 class="text-center">Tambah Data Aktivasi Member</h2>
            </div>
            <form action="{{ url('/konfirmasiAktivasi') }}" method="get" enctype="multipart/form-data">
                <div class="card-body p-3" style="background-color: #9FE8FA">
                    <div class="mt-3 mb-3">
                        <div class="d-flex align-items-center justify-content-evenly">
                            <div class="col-md-4">
                                <label for="" class="form-label">Pilih Member</label>
                                <select class="form-control" aria-label="Default select example" name="ID_MEMBER">
                                    <option value="" hidden>Pilih Member</option>
                                    @if ($member->first() != null)
                                        @foreach ($member as $item)
                                            <option value="{{ $item->ID_MEMBER }}">
                                                {{ $item->NAMA_MEMBER }}</option>
                                        @endforeach
                                    @else
                                        <option value=""disabled>...</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="JUMLAH_DEPOSIT" class="form-label">Nominal Uang</label>
                                <div class="d-flex align-items-center">
                                    Rp.<input type="text"
                                        class="form-control ms-2 @error('JUMLAH_DEPOSIT') is-invalid @enderror"
                                        name="JUMLAH_DEPOSIT" id="JUMLAH_DEPOSIT" value="3000000" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card-footer text-muted p-4" style="background-color: #73D2F3">
                    <div class="d-flex align-items-center justify-content-center">
                        <a class="btn btn-dark" href="{{ url('/transaksiAktivasi') }}">
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
