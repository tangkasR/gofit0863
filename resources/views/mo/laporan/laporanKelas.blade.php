@extends('/dashboard')
@section('container')
    <div class="d-flex align-items-center justify-content-center mt-4  mb-4 no-print" style="width:90%; heigh:50%">
        <div class="card" style="width: 70%">
            <div class="card-header-addPage py-4" style="background-color: #73D2F3">
                <h2 class="text-center">LAPORAN KELAS</h2>
            </div>
            <div class="card-body" style="background-color: #9FE8FA">
                <div class="mt-3">
                    <form action="{{ url('laporanKelas') }}" method="get" enctype="multipart/form-data">
                        @csrf
                        <div class="d-flex align-items-center justify-content-evenly">
                            <div class="mb-3 col-md-4">
                                <label class="font-weight-bold mb-2">Tahun</label>
                                <select class="form-control mb-3" aria-label="Default select example" name="year_filter">
                                    <option value="" hidden>Pilih Tahun</option>
                                    @php
                                        $year = \Carbon\Carbon::now()->addYears(1);
                                    @endphp
                                    @for ($i = 0; $i < 3; $i++)
                                        @php
                                            $year->subYears(1);
                                        @endphp
                                        <option value={{ $year->format('Y') }}>
                                            {{ $year->format('Y') }}</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="mb-3 col-md-4">
                                <label class="font-weight-bold mb-2">Bulan</label>
                                <select class="form-control mb-3" aria-label="Default select example" name="month_filter">
                                    <option value="" hidden>Pilih Bulan</option>
                                    @php
                                        $month = \Carbon\Carbon::create();
                                    @endphp
                                    @for ($i = 0; $i < 12; $i++)
                                        <option value={{ $month->format('m') }}>
                                            {{ $month->translatedformat('F') }}</option>
                                        @php
                                            $month->addMonth(1);
                                        @endphp
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-evenly">
                            <div class="mb-3 col-md-4">
                                <label class="font-weight-bold mb-2">Manajer Operasional</label>
                                <input type='text' class="form-control mb-3"name="ID_PEGAWAI"
                                    placeholder="Input date of birth member" autocomplete="off"
                                    value="P{{ $pegawai->ID_PEGAWAI }} / {{ $pegawai->NAMA_PEGAWAI }}" disabled />
                            </div>

                            <div class="mb-3 col-md-4">
                            </div>

                        </div>
                        <div class="card-footer text-muted p-4" style="background-color: #73D2F3">
                            <div class="d-flex align-items-left justify-content-left">
                                <button type="submit" class="btn btn-primary ms-3">Cari</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if (!Session::get('print'))
        {{-- <div class="alert alert-danger">
        Data report not found. Please input month and year!
    </div> --}}
    @else
        @php
            $data_class_activity = Session::get('data_class_activity');
        @endphp
        <div class="card"style="background-color:#cfe7f7">
            <div class="mb-2 ms-3">
                <h3 class="card-title">LAPORAN AKTIVITAS KELAS {{ Session::get('year') }}</h3>
                @if ($data_class_activity)
                    <button type="button" class="btn bg-info text-white mt-2 no-print" onclick="window.print()"> <i
                            class="fas fa-solid fa-print fa-fw me-3"></i>Print Laporan</button>
                @endif

            </div>
        </div>

        <div class=" card my-1 p-3 bg-body rounded shadow-sm mt-3">

            <h3>GoFit</h3>
            <p>Jl. Centralpark No.10 Yogyakarta</p>
            <h3>LAPORAN AKTIVITAS KELAS BULANAN</h3>
            <div class="d-flex">
                <p>BULAN: {{ \Carbon\Carbon::now()->month(Session::get('month'))->translatedformat('F') }} </p>
                <p class="ms-3">PERIODE: {{ Session::get('year') }}</p>
            </div>

            <p>Tanggal cetak: {{ \Carbon\Carbon::now()->translatedformat('d M Y') }}</p>

            <hr style="width: 100%; color: black; height: 1px; background-color:black;" />

            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th class="col-md-2">Kelas</th>
                        <th class="col-md-2">Instruktur</th>
                        <th class="col-md-2">Jumlah Peserta</th>
                        <th class="col-md-2">Jumlah Libur</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data_class_activity as $item)
                        <tr>
                            <td>{{ $item->kelas }}</td>
                            <td>{{ $item->instruktur }}</td>
                            <td>{{ $item->jumlah_peserta_kelas }}</td>
                            <td>{{ $item->jumlah_libur }}</td>
                        </tr>
                    @empty
                        <div class="alert alert-danger">
                            Data report empty
                        </div>
                    @endforelse
                </tbody>
            </table>
            {{-- <div>
        {{ $members->links('pagination::bootstrap-5') }}
    </div> --}}
            {{-- </div>

    <div class="card mt-5">
        <div class="card-body mr-5">
            <canvas id="myChart" height="100px"></canvas>
        </div>
    </div> --}}
            {{-- <div class="card mt-5">
        <div class="card-body ms-5">
            <canvas id="myChart2" height="100px"></canvas>
        </div>
    </div> --}}
    @endif
@endsection
