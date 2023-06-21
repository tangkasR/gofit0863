@extends('/dashboard')
@section('container')
    <div class="d-flex align-items-center justify-content-center mt-4  mb-4 no-print" style="width:90%; heigh:50%">
        <div class="card" style="width: 70%">
            <div class="card-header-addPage py-4" style="background-color: #73D2F3">
                <h2 class="text-center">LAPORAN PENDAPATAN</h2>
            </div>
            <div class="card-body" style="background-color: #9FE8FA">
                <div class="mt-3">
                    <form action="{{ url('laporanPendapatan') }}" method="get" enctype="multipart/form-data">
                        @csrf
                        <div class="d-flex align-items-center justify-content-evenly">
                            <div class="mb-3 col-md-4">
                                <label class="font-weight-bold mb-2">Tahun</label>
                                <select class="form-control mb-3" aria-label="Default select example" name="year_filter"
                                    id="deposit">
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
                                <label class="font-weight-bold mb-2">Manajer Operasional</label>
                                <input type='text' class="form-control mb-3"name="ID_PEGAWAI"
                                    placeholder="Input date of birth member" autocomplete="off"
                                    value="P{{ $pegawai->ID_PEGAWAI }} / {{ $pegawai->NAMA_PEGAWAI }}" disabled />
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
    @if (
        !($data_activation && $data_depo_class && $data_total_income) &&
            !(Session::get('data_activation') && Session::get('data_depo_class') && Session::get('data_total_income')))
        {{-- <div class="alert alert-danger">
        Data report not found. Please input year!
    </div> --}}
    @else
        @php
            $data_activation = Session::get('data_activation');
            $data_depo_class = Session::get('data_depo_class');
            $data_total_income = Session::get('data_total_income');
        @endphp
        <div class="card"style="background-color:#cfe7f7">
            {{-- <div class="card-header"style="background-color:#F9E2AF">
            <h3 class="card-title">INCOME REPORT {{ Session::get('year') }}</h3>
        </div> --}}
            <h3 class="card-title ms-3">Laporan Pendapatan {{ Session::get('year') }}</h3>
            <div class="mb-2 ms-3">
                <button type="button" class="btn bg-info text-white mt-2 no-print" onclick="window.print()"> <i
                        class="fas fa-solid fa-print fa-fw me-3"></i>Print
                    Laporan</button>
            </div>
        </div>
        <!-- START DATA -->
        <div class=" card my-1 p-3 bg-body rounded shadow-sm mt-3">

            <h3>GoFit</h3>
            <p>Jl. Centralpark No.10 Yogyakarta</p>
            <h3>LAPORAN PENDAPATAN TAHUNAN</h3>
            <p>PERIODE: {{ Session::get('year') }}</p>
            <p>Tanggal cetak: {{ \Carbon\Carbon::now()->translatedformat('d M Y') }}</p>

            <hr style="width: 100%; color: black; height: 1px; background-color:black;" />

            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th class="col-md-2">Bulan</th>
                        <th class="col-md-2">Transaksi Aktivasi</th>
                        <th class="col-md-2">Transaksi Deposit</th>
                        <th class="col-md-2">Total</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td class="col-md-2">Januari</td>
                        @if ($data_activation[0])
                            <td>{{ $data_activation[0][0]->total_income_activation }}</td>
                        @else
                            <td>0</td>
                        @endif
                        @if ($data_depo_class[0])
                            <td class="col-md-2">
                                {{ $data_depo_class[0][0]->total_income_deposit }}
                            </td>
                        @else
                            <td>0</td>
                        @endif
                        @if ($data_total_income[0])
                            <td class="col-md-2">{{ $data_total_income[0][0]->total_income }}</td>
                            @php
                                $temp_total_all = $data_total_income[0][0]->total_income;
                            @endphp
                        @else
                            <td>0</td>
                            @php
                                $temp_total_all = 0;
                            @endphp
                        @endif
                    </tr>

                    <tr>
                        <td class="col-md-2">Februari</td>
                        @if ($data_activation[1])
                            <td>{{ $data_activation[1][0]->total_income_activation }}</td>
                        @else
                            <td>0</td>
                        @endif
                        @if ($data_depo_class[1])
                            <td class="col-md-2">{{ $data_depo_class[1][0]->total_income_deposit }}</td>
                        @else
                            <td>0</td>
                        @endif
                        @if ($data_total_income[1])
                            <td class="col-md-2">{{ $data_total_income[1][0]->total_income }}</td>
                            @php
                                $temp_total_all += $data_total_income[1][0]->total_income;
                            @endphp
                        @else
                            <td>0</td>
                            @php
                                $temp_total_all += 0;
                            @endphp
                        @endif
                    </tr>

                    <tr>
                        <td class="col-md-2">Maret</td>
                        @if ($data_activation[2])
                            <td>{{ $data_activation[2][0]->total_income_activation }}</td>
                        @else
                            <td>0</td>
                        @endif
                        @if ($data_depo_class[2])
                            <td class="col-md-2">{{ $data_depo_class[2][0]->total_income_deposit }}</td>
                        @else
                            <td>0</td>
                        @endif
                        @if ($data_total_income[2])
                            <td class="col-md-2">{{ $data_total_income[2][0]->total_income }}</td>
                            @php
                                $temp_total_all += $data_total_income[2][0]->total_income;
                            @endphp
                        @else
                            <td>0</td>
                            @php
                                $temp_total_all += 0;
                            @endphp
                        @endif
                    </tr>
                    <tr>
                        <td class="col-md-2">April</td>
                        @if ($data_activation[3])
                            <td>{{ $data_activation[3][0]->total_income_activation }}</td>
                        @else
                            <td>0</td>
                        @endif
                        @if ($data_depo_class[3])
                            <td class="col-md-2">{{ $data_depo_class[3][0]->total_income_deposit }}</td>
                        @else
                            <td>0</td>
                        @endif
                        @if ($data_total_income[3])
                            <td class="col-md-2">{{ $data_total_income[3][0]->total_income }}</td>
                            @php
                                $temp_total_all += $data_total_income[3][0]->total_income;
                            @endphp
                        @else
                            <td>0</td>
                            @php
                                $temp_total_all += 0;
                            @endphp
                        @endif
                    </tr>
                    <tr>
                        <td class="col-md-2">Mei</td>
                        @if ($data_activation[4])
                            <td>{{ $data_activation[4][0]->total_income_activation }}</td>
                        @else
                            <td>0</td>
                        @endif
                        @if ($data_depo_class[4])
                            <td class="col-md-2">{{ $data_depo_class[4][0]->total_income_deposit }}</td>
                        @else
                            <td>0</td>
                        @endif
                        @if ($data_total_income[4])
                            <td class="col-md-2">{{ $data_total_income[4][0]->total_income }}</td>
                            @php
                                $temp_total_all += $data_total_income[4][0]->total_income;
                            @endphp
                        @else
                            <td>0</td>
                            @php
                                $temp_total_all += 0;
                            @endphp
                        @endif
                    </tr>
                    <tr>
                        <td class="col-md-2">Juni</td>
                        @if ($data_activation[5])
                            <td>{{ $data_activation[5][0]->total_income_activation }}</td>
                        @else
                            <td>0</td>
                        @endif
                        @if ($data_depo_class[5])
                            <td class="col-md-2">{{ $data_depo_class[5][0]->total_income_deposit }}</td>
                        @else
                            <td>0</td>
                        @endif
                        @if ($data_total_income[5])
                            <td class="col-md-2">{{ $data_total_income[5][0]->total_income }}</td>
                            @php
                                $temp_total_all += $data_total_income[5][0]->total_income;
                            @endphp
                        @else
                            <td>0</td>
                            @php
                                $temp_total_all += 0;
                            @endphp
                        @endif
                    </tr>
                    <tr>
                        <td class="col-md-2">Juli</td>
                        @if ($data_activation[6])
                            <td>{{ $data_activation[6][0]->total_income_activation }}</td>
                        @else
                            <td>0</td>
                        @endif
                        @if ($data_depo_class[6])
                            <td class="col-md-2">{{ $data_depo_class[6][0]->total_income_deposit }}</td>
                        @else
                            <td>0</td>
                        @endif
                        @if ($data_total_income[6])
                            <td class="col-md-2">{{ $data_total_income[6][0]->total_income }}</td>
                            @php
                                $temp_total_all += $data_total_income[6][0]->total_income;
                            @endphp
                        @else
                            <td>0</td>
                            @php
                                $temp_total_all += 0;
                            @endphp
                        @endif
                    </tr>
                    <tr>
                        <td class="col-md-2">Agustus</td>
                        @if ($data_activation[7])
                            <td>{{ $data_activation[7][0]->total_income_activation }}</td>
                        @else
                            <td>0</td>
                        @endif
                        @if ($data_depo_class[7])
                            <td class="col-md-2">{{ $data_depo_class[7][0]->total_income_deposit }}</td>
                        @else
                            <td>0</td>
                        @endif
                        @if ($data_total_income[7])
                            <td class="col-md-2">{{ $data_total_income[7][0]->total_income }}</td>
                            @php
                                $temp_total_all += $data_total_income[7][0]->total_income;
                            @endphp
                        @else
                            <td>0</td>
                            @php
                                $temp_total_all += 0;
                            @endphp
                        @endif
                    </tr>
                    <tr>
                        <td class="col-md-2">September</td>
                        @if ($data_activation[8])
                            <td>{{ $data_activation[8][0]->total_income_activation }}</td>
                        @else
                            <td>0</td>
                        @endif
                        @if ($data_depo_class[8])
                            <td class="col-md-2">{{ $data_depo_class[8][0]->total_income_deposit }}</td>
                        @else
                            <td>0</td>
                        @endif
                        @if ($data_total_income[8])
                            <td class="col-md-2">{{ $data_total_income[8][0]->total_income }}</td>
                            @php
                                $temp_total_all += $data_total_income[8][0]->total_income;
                            @endphp
                        @else
                            <td>0</td>
                            @php
                                $temp_total_all += 0;
                            @endphp
                        @endif
                    </tr>
                    <tr>
                        <td class="col-md-2">Oktober</td>
                        @if ($data_activation[9])
                            <td>{{ $data_activation[9][0]->total_income_activation }}</td>
                        @else
                            <td>0</td>
                        @endif
                        @if ($data_depo_class[9])
                            <td class="col-md-2">{{ $data_depo_class[9][0]->total_income_deposit }}</td>
                        @else
                            <td>0</td>
                        @endif
                        @if ($data_total_income[9])
                            <td class="col-md-2">{{ $data_total_income[9][0]->total_income }}</td>
                            @php
                                $temp_total_all += $data_total_income[9][0]->total_income;
                            @endphp
                        @else
                            <td>0</td>
                            @php
                                $temp_total_all += 0;
                            @endphp
                        @endif
                    </tr>
                    <tr>
                        <td class="col-md-2">November</td>
                        @if ($data_activation[10])
                            <td>{{ $data_activation[10][0]->total_income_activation }}</td>
                        @else
                            <td>0</td>
                        @endif
                        @if ($data_depo_class[10])
                            <td class="col-md-2">{{ $data_depo_class[10][0]->total_income_deposit }}</td>
                        @else
                            <td>0</td>
                        @endif
                        @if ($data_total_income[10])
                            <td class="col-md-2">{{ $data_total_income[10][0]->total_income }}</td>
                            @php
                                $temp_total_all += $data_total_income[10][0]->total_income;
                            @endphp
                        @else
                            <td>0</td>
                            @php
                                $temp_total_all += 0;
                            @endphp
                        @endif
                    </tr>
                    <tr>
                        <td class="col-md-2">Desember</td>
                        @if ($data_activation[11])
                            <td>{{ $data_activation[11][0]->total_income_activation }}</td>
                        @else
                            <td>0</td>
                        @endif
                        @if ($data_depo_class[11])
                            <td class="col-md-2">{{ $data_depo_class[11][0]->total_income_deposit }}</td>
                        @else
                            <td>0</td>
                        @endif
                        @if ($data_total_income[11])
                            <td class="col-md-2">{{ $data_total_income[11][0]->total_income }}</td>
                            @php
                                $temp_total_all += $data_total_income[11][0]->total_income;
                            @endphp
                        @else
                            <td>0</td>
                            @php
                                $temp_total_all += 0;
                            @endphp
                        @endif
                    </tr>
                    <tr>
                        <td class="col-md-2 text-center" colspan="3">Total</td>
                        <td>{{ $temp_total_all }}</td>
                    </tr>
                </tbody>
            </table>
            {{-- <div>
        {{ $members->links('pagination::bootstrap-5') }}
    </div> --}}
        </div>

        <div class="card mt-5">
            <div class="card-body mr-5">
                <canvas id="myChart" height="100px"></canvas>
            </div>
        </div>
        {{-- <div class="card mt-5">
        <div class="card-body ms-5">
            <canvas id="myChart2" height="100px"></canvas>
        </div>
    </div> --}}
    @endif
@endsection

@section('footer-script')
    <script type="text/javascript">
        var year = {{ Session::get('year') }};
        var label = {{ Js::from(Session::get('report_keys')) }}
        var value = {{ Js::from(Session::get('report_value')) }}

        console.log(value)

        const data = {
            labels: label,
            datasets: [{
                label: 'Report Income Activation and Deposit ' + year,
                backgroundColor: '#9fc5e8',
                borderColor: '#3d85c6',
                borderWidth: 1,
                data: value,
            }]
        };

        const config = {
            type: 'bar',
            data: data,
            options: {

            }
        };

        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>
@endsection
