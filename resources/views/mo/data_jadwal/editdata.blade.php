@extends('/dashboard')
@section('container')
    <div class="d-flex align-items-center justify-content-center mt-4" style="width:90%; heigh:50%">
        <div class="card" style="width: 70%">
            <div class="card-header-addPage py-4" style="background-color: #73D2F3">
                <h2 class="text-center">Ubah Data Jadwal</h2>
            </div>
            <div class="card-body" style="background-color: #9FE8FA">
                <div class="mt-3">
                    <form method="post" action="{{ url('/editJadwal/' . $jadwal->ID_JADWAL_UMUM) }}">
                        @csrf
                        @method('put')
                        <div class="d-flex align-items-center justify-content-evenly">
                            <div class="mb-3 col-md-4">
                                <label for="HARI_JADWAL_UMUM" class="form-label">Hari</label>
                                <input type="text" class="form-control  @error('HARI_JADWAL_UMUM') is-invalid @enderror"
                                    name="HARI_JADWAL_UMUM" id="HARI_JADWAL_UMUM" value="{{ $jadwal->HARI_JADWAL_UMUM }}">
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="WAKTU_JADWAL_UMUM" class="form-label">Waktu</label>
                                <input type="text" class="form-control  @error('WAKTU_JADWAL_UMUM') is-invalid @enderror"
                                    id="WAKTU_JADWAL_UMUM" name="WAKTU_JADWAL_UMUM"
                                    value="{{ $jadwal->WAKTU_JADWAL_UMUM }}">
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-evenly">
                            <div class="mb-3 col-md-4">
                                <label for="KELAS" class="form-label">Kelas</label>
                                <div class="input-group">
                                    <select class="form-select" id="KELAS" name="ID_KELAS">
                                        <option value="" selected hidden>Pilih Kelas</option>
                                        @foreach ($kelas as $item)
                                            <option value="{{ $item->ID_KELAS }}">{{ $item->NAMA_KELAS }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="INSTRUKTUR" class="form-label">Instruktur</label>
                                <div class="input-group">
                                    <select class="form-select" id="INSTRUKTUR" name="ID_INSTRUKTUR">
                                        <option value="" selected hidden>Pilih Instruktur</option>
                                        @foreach ($instruktur as $item)
                                            <option value="{{ $item->ID_INSTRUKTUR }}">{{ $item->NAMA_INSTRUKTUR }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-muted p-4" style="background-color: #73D2F3">
                            <div class="d-flex align-items-center justify-content-center">
                                <a class="btn btn-dark" href="{{ url('/jadwal') }}">
                                    Batal
                                </a>
                                <button type="submit" class="ms-3 btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
