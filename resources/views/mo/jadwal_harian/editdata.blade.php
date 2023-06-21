@extends('dashboard')
@section('container')
    <div class="d-flex align-items-center justify-content-center mt-4" style="width:90%; heigh:50%">
        <div class="card" style="width: 70%">
            <div class="card-header-addPage py-4" style="background-color: #73D2F3">
                <h2 class="text-center">Ubah Data Jadwal Harian</h2>
            </div>
            <div class="card-body" style="background-color: #9FE8FA">
                <div class="mt-3">
                    <form action="{{ url('/editJadwalHarian/' . $jadwalHarian->TANGGAL_JADWAL_HARIAN) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="align-items-center justify-content-center ms-5 me-5">
                            <div class="mb-3">
                                <label for="" class="form-label  ">Instruktur</label>
                                <select class="form-control" aria-label="Default select example" name="ID_INSTRUKTUR">
                                    <option value="" hidden>Pilih Instruktur</option>
                                    @foreach ($instruktur as $item_Instruktur)
                                        <option value="{{ $item_Instruktur->ID_INSTRUKTUR }}"
                                            {{ $jadwalHarian->ID_INSTRUKTUR == $item_Instruktur->ID_INSTRUKTUR ? 'selected' : '' }}>
                                            {{ $item_Instruktur->NAMA_INSTRUKTUR }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Status</label>
                                <input type="text" class="form-control " name="STATUS_JADWAL_HARIAN"
                                    value="{{ $jadwalHarian->STATUS_JADWAL_HARIAN }}" placeholder="Masukan status"
                                    autocomplete="off" />
                            </div>
                        </div>
                        <div class="card-footer text-muted p-3" style="background-color: #73D2F3">
                            <div class="d-flex align-items-center justify-content-center">
                                <a class="btn btn-dark" href="{{ url('/jadwalHarian') }}">
                                    Batal
                                </a>
                                <button type="submit" class="btn btn-primary ms-3">Simpan</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
