@extends('/dashboard')
@section('container')
    <div class="d-flex align-items-center justify-content-center mt-4" style="width:90%; heigh:50%">
        <div class="card" style="width: 70%">
            <div class="card-header-addPage py-4" style="background-color: #73D2F3">
                <h2 class="text-center">Tambah Data Instruktur</h2>
            </div>
            <div class="card-body" style="background-color: #9FE8FA">
                <div class="">
                    <form method='post' action='{{ url('/storeInstruktur') }}'>
                        @csrf
                        <div class="d-flex align-items-center justify-content-evenly">
                            <div class="mb-3 col-md-4">
                                <label for="NAMA_INSTRUKTUR" class="form-label  ">Nama</label>
                                <input style="width: 100%" type="text"
                                    class="form-control @error('NAMA_INSTRUKTUR') is-invalid @enderror" id="NAMA_INSTRUKTUR"
                                    name="NAMA_INSTRUKTUR">
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="ALAMAT_INSTRUKTUR" class="form-label">Alamat</label>
                                <input style="width: 100%" type="text"
                                    class="form-control @error('ALAMAT_INSTRUKTUR') is-invalid @enderror"
                                    id="ALAMAT_INSTRUKTUR" name="ALAMAT_INSTRUKTUR">
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-evenly">
                            <div class="mb-3 col-md-4">
                                <label for="NO_TELEPON_INSTRUKTUR" class="form-label">No Telepon</label>
                                <input style="width: 100%" type="text"
                                    class="form-control @error('NO_TELEPON_INSTRUKTUR') is-invalid @enderror"
                                    id="NO_TELEPON_INSTRUKTUR" name="NO_TELEPON_INSTRUKTUR">
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="UMUR_INSTRUKTUR" class="form-label">Umur</label>
                                <input style="width: 100%" type="text"
                                    class="form-control @error('UMUR_INSTRUKTUR') is-invalid @enderror" id="UMUR_INSTRUKTUR"
                                    name="UMUR_INSTRUKTUR">
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-evenly">
                            <div class="mb-3 col-md-4">
                                <label for="JENIS_KELAMIN_INSTRUKTUR" class="form-label">Jenis Kelamin</label>
                                <div class="input-group">
                                    <select class="form-select" id="JENIS_KELAMIN_INSTRUKTUR"
                                        name="JENIS_KELAMIN_INSTRUKTUR">
                                        <option value="" selected hidden>Pilih Jenis Kelamin</option>
                                        <option value="Pria">Pria</option>
                                        <option value="Wanita">Wanita</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="TANGGAL_LAHIR_INSTRUKTUR" class="form-label">Tanggal Lahir Instruktur</label>
                                <input style="width: 100%" type="date"
                                    class="form-control @error('TANGGAL_LAHIR_INSTRUKTUR') is-invalid @enderror"
                                    id="TANGGAL_LAHIR_INSTRUKTUR" name="TANGGAL_LAHIR_INSTRUKTUR">
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-evenly">
                            <div class="mb-3 col-md-4">
                                <label for="EMAIL_INSTRUKTUR" class="form-label">Email</label>
                                <input style="width: 100%" type="email"
                                    class="form-control @error('EMAIL_INSTRUKTUR') is-invalid @enderror"
                                    id="EMAIL_INSTRUKTUR" name="EMAIL_INSTRUKTUR">
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="password" class="form-label">Password</label>
                                <input style="width: 100%"type="password"
                                    class="form-control @error('password') is-invalid @enderror" id="password"
                                    name="password">
                            </div>
                        </div>
                        <div class="card-footer text-muted p-4" style="background-color: #73D2F3">
                            <div class="d-flex align-items-center justify-content-center">
                                <a class="btn btn-dark" href="{{ url('/instruktur') }}">
                                    Batal
                                </a>
                                <button type="submit" class="btn btn-primary ms-3">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
