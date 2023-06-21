@extends('/dashboard')
@section('container')
    <div class="d-flex align-items-center justify-content-center mt-4" style="width:90%; heigh:50%">
        <div class="card" style="width: 70%">
            <div class="card-header-addPage py-4" style="background-color: #73D2F3">
                <h2 class="text-center">Tambah Data Member</h2>
            </div>
            <div class="card-body" style="background-color: #9FE8FA">
                <div class="mt-3">
                    <form method='post' action='{{ url('/storeMember') }}'>
                        @csrf
                        <div class="d-flex align-items-center justify-content-evenly">
                            <div class="mb-3 col-md-4">
                                <label for="NAMA_MEMBER" class="form-label">Nama</label>
                                <input type="text" class="form-control @error('NAMA_MEMBER') is-invalid @enderror"
                                    name="NAMA_MEMBER" id="NAMA_MEMBER">
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="ALAMAT_MEMBER" class="form-label ">Alamat</label>
                                <input type="text" class="form-control @error('ALAMAT_MEMBER') is-invalid @enderror"
                                    id="ALAMAT_MEMBER" name="ALAMAT_MEMBER">
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-evenly">
                            <div class="mb-3 col-md-4">
                                <label for="TELEPON_MEMBER" class="form-label">No Telepon</label>
                                <input type="text" class="form-control @error('TELEPON_MEMBER') is-invalid @enderror"
                                    id="TELEPON_MEMBER" name="TELEPON_MEMBER">
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="TANGGAL_LAHIR_MEMBER" class="form-label">Tanggal Lahir</label>
                                <input type="date"
                                    class="form-control @error('TANGGAL_LAHIR_MEMBER') is-invalid @enderror"
                                    id="TANGGAL_LAHIR_MEMBER" name="TANGGAL_LAHIR_MEMBER">
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-evenly">
                            <div class="mb-3 col-md-4">
                                <label for="JENIS_KELAMIN_MEMBER" class="form-label">Jenis Kelamin</label>
                                <div class="input-group">
                                    <select class="form-select" id="JENIS_KELAMIN_MEMBER" name="JENIS_KELAMIN_MEMBER">
                                        <option selected hidden value="">Pilih
                                            Jenis Kelamin</option>
                                        <option value="pria">Pria</option>
                                        <option value="wanita">Wanita</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-evenly">

                            <div class="mb-3 col-md-4">
                                <label for="EMAIL" class="form-label">Email</label>
                                <input type="email" class="form-control @error('EMAIL') is-invalid @enderror"
                                    id="EMAIL" name="EMAIL">
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password">
                            </div>

                        </div>
                        <div class="card-footer text-muted p-4" style="background-color: #73D2F3">
                            <div class="d-flex align-items-center justify-content-center">
                                <a class="btn btn-dark" href="{{ url('/member') }}">
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
