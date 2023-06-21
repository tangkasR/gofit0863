@extends('/dashboard')
@section('container')
    <div class="p-2" style="margin-left:-10%;width:112%;background-color: #ABD9FF">
        <h1 style="margin-left: 10%;color:#ECF9FF">Jadwal Harian</h1>
    </div>
    <div class="d-flex align-items-center justify-content-between">
        <div class="mt-4 mb-4" style="width:80%">
            <form action="{{ url('/searchJadwalHarian') }}" class=" navbar-search" method="get">
                <div class="d-flex align-items-center">
                    <div class="bg-white rounded ms-2">
                        <button class="btn shadow" type="submit" style="background-color: #21E1E1;color:#FFFBEB">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-search" viewBox="0 0 16 16">
                                <path
                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                            </svg>
                        </button>
                    </div>
                    <input type="text" class="form-control shadow p-2 bg-white rounded ms-2" placeholder="Search for..."
                        aria-label="Search" aria-describedby="basic-addon2" name="search">
                </div>
            </form>
        </div>
        <div class="shadow p-0 rounded">
            <a class="btn btn-info" style="color: white" href="{{ url('/generateJadwal') }}">
                Generate Jadwal Harian
            </a>
        </div>

    </div>

    <div class="mb-4 container">
        <div class="table-responsive">
            <div class="shadow p-2 border-light rounded" style="background-color: #26BAEE">
                <table class="table table-bordered text-center"
                    style="background-color: #DAF5FF; border:#009FBD;border-radius: 2px;border-spacing: 10px;">
                    <thead>
                        <th style="background-color: #8ED6FF">Hari</th>
                        <th colspan="12" style="background-color: #73D2F3">Waktu</th>
                    </thead>

                    <tbody>
                        @if ($tanggal != null)
                            {{-- <tr style="color:black">
                            <td>
                                @if ($tanggal != null)
                                    <div>{{ $tanggal->TANGGAL_JADWAL_HARIAN->translatedformat('l') }}</div>
                                    <div>{{ $tanggal->TANGGAL_JADWAL_HARIAN->format('Y M d') }}</div>
                                @endif
                            </td>
                            @foreach ($jadwalHarian as $item)
                                @if ($item->jadwal->HARI_JADWAL_UMUM == $tanggal->TANGGAL_JADWAL_HARIAN->translatedformat('l'))
                                    <td>
                                        <div>{{ $item->TANGGAL_JADWAL_HARIAN->format('H:i:s') }}</div>
                                        <div>{{ $item->jadwal->kelas->NAMA_KELAS }}</div>
                                        <div>{{ $item->instruktur->NAMA_INSTRUKTUR }}</div>
                                        <div>({{ $item->STATUS_JADWAL_HARIAN }})</div>
                                        <div class="mt-1">
                                            <form onsubmit="return confirm('Are you sure?');">
                                                <a style="color:#FFFBEB" class='btn btn-xs btn-info'
                                                    href="{{ url('/editPageJadwalHarian/' . $item->TANGGAL_JADWAL_HARIAN) }}">
                                                    <span class="glyphicon glyphicon-edit"></span> Edit
                                                </a>
                                            </form>
                                        </div>
                                    </td>
                                @endif
                            @endforeach --}}

                            <tr style="color:black">
                                <th class="align-middle" style="background-color: #8ED6FF">
                                    <div>{{ $tanggal->TANGGAL_JADWAL_HARIAN->translatedformat('l') }}</div>
                                    <div>{{ $tanggal->TANGGAL_JADWAL_HARIAN->translatedformat('Y M d') }}</div>
                                    </td>
                                    @foreach ($jadwalHarian as $item)
                                        @if ($item->jadwal->HARI_JADWAL_UMUM == $tanggal->TANGGAL_JADWAL_HARIAN->translatedformat('l'))
                                <td style="font-family:sans-serif;font-size: 110%;font:bold">
                                    <span>{{ $item->jadwal->kelas->NAMA_KELAS }}</span>
                                    <div>{{ $item->jadwal->WAKTU_JADWAL_UMUM }}</div>
                                    <div>
                                        {{ $item->instruktur->NAMA_INSTRUKTUR }}</div>
                                    <div>({{ $item->STATUS_JADWAL_HARIAN }})</div>
                                    <div class="d-flex align-content-center justify-content-center">
                                        <a class="btn btn-secondary"
                                            href="{{ url('/editPageJadwalHarian/' . $item->TANGGAL_JADWAL_HARIAN) }}">
                                            <span class="glyphicon glyphicon-edit"></span> Edit
                                        </a>
                                    </div>
                                </td>
                        @endif
                        @endforeach
                        </tr>



                        {{-- <tr style="color:black">
                            <td>
                                @if ($tanggal != null)
                                    <div>{{ $tanggal->TANGGAL_JADWAL_HARIAN->addDays(1)->format('l') }}</div>
                                    <div>{{ $tanggal->TANGGAL_JADWAL_HARIAN->addDays(1)->format('Y M d') }}</div>
                                @endif
                            </td>
                            @foreach ($jadwalHarian as $item)
                                @if ($item->jadwal->HARI_JADWAL_UMUM == $tanggal->TANGGAL_JADWAL_HARIAN->addDays(1)->translatedformat('l'))
                                    <td>
                                        <div> {{ $item->TANGGAL_JADWAL_HARIAN->format('H:i:s') }}</div>
                                        <div>{{ $item->jadwal->kelas->NAMA_KELAS }}</div>
                                        <div>{{ $item->instruktur->NAMA_INSTRUKTUR }}</div>
                                        <div>({{ $item->STATUS_JADWAL_HARIAN }})</div>
                                        <div class="mt-1">
                                            <form onsubmit="return confirm('Are you sure?');">
                                                <a style="color:#FFFBEB" class='btn btn-xs btn-info'
                                                    href="{{ url('/editPageJadwalHarian/' . $item->TANGGAL_JADWAL_HARIAN) }}">
                                                    <span class="glyphicon glyphicon-edit"></span> Edit
                                                </a>
                                            </form>
                                        </div>
                                    </td>
                                @endif
                            @endforeach
                        </tr> --}}
                        <tr style="color:black">
                            <th class="align-middle" style="background-color: #8ED6FF">
                                <div>{{ $tanggal->TANGGAL_JADWAL_HARIAN->addDays(1)->translatedformat('l') }}</div>
                                <div>{{ $tanggal->TANGGAL_JADWAL_HARIAN->addDays(1)->translatedformat('Y M d') }}</div>
                                </td>
                                @foreach ($jadwalHarian as $item)
                                    @if ($item->jadwal->HARI_JADWAL_UMUM == $tanggal->TANGGAL_JADWAL_HARIAN->addDays(1)->translatedformat('l'))
                            <td style="font-family:sans-serif;font-size: 110%;font:bold">
                                <span>{{ $item->jadwal->kelas->NAMA_KELAS }}</span>
                                <div>{{ $item->jadwal->WAKTU_JADWAL_UMUM }}</div>
                                <div>
                                    {{ $item->instruktur->NAMA_INSTRUKTUR }}</div>
                                <div>({{ $item->STATUS_JADWAL_HARIAN }})</div>
                                <div class="d-flex align-content-center justify-content-center">
                                    <a class="btn btn-secondary"
                                        href="{{ url('/editPageJadwalHarian/' . $item->TANGGAL_JADWAL_HARIAN) }}">
                                        <span class="glyphicon glyphicon-edit"></span> Edit
                                    </a>
                                </div>
                            </td>
                            @endif
                            @endforeach
                        </tr>



                        {{-- <tr style="color:black">
                            <td>
                                @if ($tanggal != null)
                                    <div>{{ $tanggal->TANGGAL_JADWAL_HARIAN->addDays(2)->format('l') }}</div>
                                    <div>{{ $tanggal->TANGGAL_JADWAL_HARIAN->addDays(2)->format('Y M d') }}</div>
                                @endif
                            </td>
                            @foreach ($jadwalHarian as $item)
                                @if ($item->jadwal->HARI_JADWAL_UMUM == $tanggal->TANGGAL_JADWAL_HARIAN->addDays(2)->translatedformat('l'))
                                    <td>
                                        <div> {{ $item->TANGGAL_JADWAL_HARIAN->format('H:i:s') }}</div>
                                        <div>{{ $item->jadwal->kelas->NAMA_KELAS }}</div>
                                        <div>{{ $item->instruktur->NAMA_INSTRUKTUR }}</div>
                                        <div>({{ $item->STATUS_JADWAL_HARIAN }})</div>
                                        <div class="mt-1">
                                            <form onsubmit="return confirm('Are you sure?');">
                                                <a style="color:#FFFBEB" class='btn btn-xs btn-info'
                                                    href="{{ url('/editPageJadwalHarian/' . $item->TANGGAL_JADWAL_HARIAN) }}">
                                                    <span class="glyphicon glyphicon-edit"></span> Edit
                                                </a>
                                            </form>
                                        </div>
                                    </td>
                                @endif
                            @endforeach
                        </tr> --}}

                        <tr style="color:black">
                            <th class="align-middle" style="background-color: #8ED6FF">
                                <div>{{ $tanggal->TANGGAL_JADWAL_HARIAN->addDays(2)->translatedformat('l') }}</div>
                                <div>{{ $tanggal->TANGGAL_JADWAL_HARIAN->addDays(2)->translatedformat('Y M d') }}</div>
                                </td>
                                @foreach ($jadwalHarian as $item)
                                    @if ($item->jadwal->HARI_JADWAL_UMUM == $tanggal->TANGGAL_JADWAL_HARIAN->addDays(2)->translatedformat('l'))
                            <td style="font-family:sans-serif;font-size: 110%;font:bold">
                                <span>{{ $item->jadwal->kelas->NAMA_KELAS }}</span>
                                <div>{{ $item->jadwal->WAKTU_JADWAL_UMUM }}</div>
                                <div>
                                    {{ $item->instruktur->NAMA_INSTRUKTUR }}</div>
                                <div>({{ $item->STATUS_JADWAL_HARIAN }})</div>
                                <div class="d-flex align-content-center justify-content-center">
                                    <a class="btn btn-secondary"
                                        href="{{ url('/editPageJadwalHarian/' . $item->TANGGAL_JADWAL_HARIAN) }}">
                                        <span class="glyphicon glyphicon-edit"></span> Edit
                                    </a>
                                </div>
                            </td>
                            @endif
                            @endforeach
                        </tr>


                        {{-- <tr style="color:black">
                            <td>
                                @if ($tanggal != null)
                                    <div>{{ $tanggal->TANGGAL_JADWAL_HARIAN->addDays(3)->format('l') }}</div>
                                    <div>{{ $tanggal->TANGGAL_JADWAL_HARIAN->addDays(3)->format('Y M d') }}</div>
                                @endif
                            </td>
                            @foreach ($jadwalHarian as $item)
                                @if ($item->jadwal->HARI_JADWAL_UMUM == $tanggal->TANGGAL_JADWAL_HARIAN->addDays(3)->translatedformat('l'))
                                    <td>
                                        <div> {{ $item->TANGGAL_JADWAL_HARIAN->format('H:i:s') }}</div>
                                        <div>{{ $item->jadwal->kelas->NAMA_KELAS }}</div>
                                        <div>{{ $item->instruktur->NAMA_INSTRUKTUR }}</div>
                                        <div>({{ $item->STATUS_JADWAL_HARIAN }})</div>
                                        <div class="mt-1">
                                            <form onsubmit="return confirm('Are you sure?');">
                                                <a style="color:#FFFBEB" class='btn btn-xs btn-info'
                                                    href="{{ url('/editPageJadwalHarian/' . $item->TANGGAL_JADWAL_HARIAN) }}">
                                                    <span class="glyphicon glyphicon-edit"></span> Edit
                                                </a>
                                            </form>
                                        </div>
                                    </td>
                                @endif
                            @endforeach
                        </tr> --}}

                        <tr style="color:black">
                            <th class="align-middle" style="background-color: #8ED6FF">
                                <div>{{ $tanggal->TANGGAL_JADWAL_HARIAN->addDays(3)->translatedformat('l') }}</div>
                                <div>{{ $tanggal->TANGGAL_JADWAL_HARIAN->addDays(3)->translatedformat('Y M d') }}</div>
                                </td>
                                @foreach ($jadwalHarian as $item)
                                    @if ($item->jadwal->HARI_JADWAL_UMUM == $tanggal->TANGGAL_JADWAL_HARIAN->addDays(3)->translatedformat('l'))
                            <td style="font-family:sans-serif;font-size: 110%;font:bold">
                                <span>{{ $item->jadwal->kelas->NAMA_KELAS }}</span>
                                <div>{{ $item->jadwal->WAKTU_JADWAL_UMUM }}</div>
                                <div>
                                    {{ $item->instruktur->NAMA_INSTRUKTUR }}</div>
                                <div>({{ $item->STATUS_JADWAL_HARIAN }})</div>
                                <div class="d-flex align-content-center justify-content-center">
                                    <a class="btn btn-secondary"
                                        href="{{ url('/editPageJadwalHarian/' . $item->TANGGAL_JADWAL_HARIAN) }}">
                                        <span class="glyphicon glyphicon-edit"></span> Edit
                                    </a>
                                </div>
                            </td>
                            @endif
                            @endforeach
                        </tr>


                        {{-- <tr style="color:black">
                            <td>
                                @if ($tanggal != null)
                                    <div>{{ $tanggal->TANGGAL_JADWAL_HARIAN->addDays(4)->format('l') }}</div>
                                    <div>{{ $tanggal->TANGGAL_JADWAL_HARIAN->addDays(4)->format('Y M d') }}</div>
                                @endif
                            </td>
                            @foreach ($jadwalHarian as $item)
                                @if ($item->jadwal->HARI_JADWAL_UMUM == $tanggal->TANGGAL_JADWAL_HARIAN->addDays(4)->translatedformat('l'))
                                    <td>
                                        <div> {{ $item->TANGGAL_JADWAL_HARIAN->format('H:i:s') }}</div>
                                        <div>{{ $item->jadwal->kelas->NAMA_KELAS }}</div>
                                        <div>{{ $item->instruktur->NAMA_INSTRUKTUR }}</div>
                                        <div>({{ $item->STATUS_JADWAL_HARIAN }})</div>
                                        <div class="mt-1">
                                            <form onsubmit="return confirm('Are you sure?');">
                                                <a style="color:#FFFBEB" class='btn btn-xs btn-info'
                                                    href="{{ url('/editPageJadwalHarian/' . $item->TANGGAL_JADWAL_HARIAN) }}">
                                                    <span class="glyphicon glyphicon-edit"></span> Edit
                                                </a>
                                            </form>
                                        </div>
                                    </td>
                                @endif
                            @endforeach
                        </tr> --}}


                        <tr style="color:black">
                            <th class="align-middle" style="background-color: #8ED6FF">
                                <div>{{ $tanggal->TANGGAL_JADWAL_HARIAN->addDays(4)->translatedformat('l') }}</div>
                                <div>{{ $tanggal->TANGGAL_JADWAL_HARIAN->addDays(4)->translatedformat('Y M d') }}</div>
                                </td>
                                @foreach ($jadwalHarian as $item)
                                    @if ($item->jadwal->HARI_JADWAL_UMUM == $tanggal->TANGGAL_JADWAL_HARIAN->addDays(4)->translatedformat('l'))
                            <td style="font-family:sans-serif;font-size: 110%;font:bold">
                                <span>{{ $item->jadwal->kelas->NAMA_KELAS }}</span>
                                <div>{{ $item->jadwal->WAKTU_JADWAL_UMUM }}</div>
                                <div>
                                    {{ $item->instruktur->NAMA_INSTRUKTUR }}</div>
                                <div>({{ $item->STATUS_JADWAL_HARIAN }})</div>
                                <div class="d-flex align-content-center justify-content-center">
                                    <a class="btn btn-secondary"
                                        href="{{ url('/editPageJadwalHarian/' . $item->TANGGAL_JADWAL_HARIAN) }}">
                                        <span class="glyphicon glyphicon-edit"></span> Edit
                                    </a>
                                </div>
                            </td>
                            @endif
                            @endforeach
                        </tr>



                        {{-- <tr style="color:black">
                            <td>
                                @if ($tanggal != null)
                                    <div>{{ $tanggal->TANGGAL_JADWAL_HARIAN->addDays(5)->format('l') }}</div>
                                    <div>{{ $tanggal->TANGGAL_JADWAL_HARIAN->addDays(5)->format('Y M d') }}</div>
                                @endif
                            </td>
                            @foreach ($jadwalHarian as $item)
                                @if ($item->jadwal->HARI_JADWAL_UMUM == $tanggal->TANGGAL_JADWAL_HARIAN->addDays(5)->translatedformat('l'))
                                    <td>
                                        <div> {{ $item->TANGGAL_JADWAL_HARIAN->format('H:i:s') }}</div>
                                        <div>{{ $item->jadwal->kelas->NAMA_KELAS }}</div>
                                        <div>{{ $item->instruktur->NAMA_INSTRUKTUR }}</div>
                                        <div>({{ $item->STATUS_JADWAL_HARIAN }})</div>
                                        <div class="mt-1">
                                            <form onsubmit="return confirm('Are you sure?');">
                                                <a style="color:#FFFBEB" class='btn btn-xs btn-info'
                                                    href="{{ url('/editPageJadwalHarian/' . $item->TANGGAL_JADWAL_HARIAN) }}">
                                                    <span class="glyphicon glyphicon-edit"></span> Edit
                                                </a>
                                            </form>
                                        </div>
                                    </td>
                                @endif
                            @endforeach
                        </tr> --}}

                        <tr style="color:black">
                            <th class="align-middle" style="background-color: #8ED6FF">
                                <div>{{ $tanggal->TANGGAL_JADWAL_HARIAN->addDays(5)->translatedformat('l') }}</div>
                                <div>{{ $tanggal->TANGGAL_JADWAL_HARIAN->addDays(5)->translatedformat('Y M d') }}</div>
                                </td>
                                @foreach ($jadwalHarian as $item)
                                    @if ($item->jadwal->HARI_JADWAL_UMUM == $tanggal->TANGGAL_JADWAL_HARIAN->addDays(5)->translatedformat('l'))
                            <td style="font-family:sans-serif;font-size: 110%;font:bold">
                                <span>{{ $item->jadwal->kelas->NAMA_KELAS }}</span>
                                <div>{{ $item->jadwal->WAKTU_JADWAL_UMUM }}</div>
                                <div>
                                    {{ $item->instruktur->NAMA_INSTRUKTUR }}</div>
                                <div>({{ $item->STATUS_JADWAL_HARIAN }})</div>
                                <div class="d-flex align-content-center justify-content-center">
                                    <a class="btn btn-secondary"
                                        href="{{ url('/editPageJadwalHarian/' . $item->TANGGAL_JADWAL_HARIAN) }}">
                                        <span class="glyphicon glyphicon-edit"></span> Edit
                                    </a>
                                </div>
                            </td>
                            @endif
                            @endforeach
                        </tr>


                        {{-- <tr style="color:black">
                            <td>
                                @if ($tanggal != null)
                                    <div>{{ $tanggal->TANGGAL_JADWAL_HARIAN->addDays(6)->format('l') }}</div>
                                    <div>{{ $tanggal->TANGGAL_JADWAL_HARIAN->addDays(6)->format('Y M d') }}</div>
                                @endif
                            </td>
                            @foreach ($jadwalHarian as $item)
                                @if ($item->jadwal->HARI_JADWAL_UMUM == $tanggal->TANGGAL_JADWAL_HARIAN->addDays(6)->translatedformat('l'))
                                    <td>
                                        <div> {{ $item->TANGGAL_JADWAL_HARIAN->format('H:i:s') }}</div>
                                        <div>{{ $item->jadwal->kelas->NAMA_KELAS }}</div>
                                        <div>{{ $item->instruktur->NAMA_INSTRUKTUR }}</div>
                                        <div>({{ $item->STATUS_JADWAL_HARIAN }})</div>
                                        <div class="mt-1">
                                            <form onsubmit="return confirm('Are you sure?');">
                                                <a style="color:#FFFBEB" class='btn btn-xs btn-info'
                                                    href="{{ url('/editPageJadwalHarian/' . $item->TANGGAL_JADWAL_HARIAN) }}">
                                                    <span class="glyphicon glyphicon-edit"></span> Edit
                                                </a>
                                            </form>
                                        </div>
                                    </td>
                                @endif
                            @endforeach
                        </tr> --}}

                        <tr style="color:black">
                            <th class="align-middle" style="background-color: #8ED6FF">
                                <div>{{ $tanggal->TANGGAL_JADWAL_HARIAN->addDays(6)->translatedformat('l') }}</div>
                                <div>{{ $tanggal->TANGGAL_JADWAL_HARIAN->addDays(6)->translatedformat('Y M d') }}</div>
                                </td>
                                @foreach ($jadwalHarian as $item)
                                    @if ($item->jadwal->HARI_JADWAL_UMUM == $tanggal->TANGGAL_JADWAL_HARIAN->addDays(6)->translatedformat('l'))
                            <td style="font-family:sans-serif;font-size: 110%;font:bold">
                                <span>{{ $item->jadwal->kelas->NAMA_KELAS }}</span>
                                <div>{{ $item->jadwal->WAKTU_JADWAL_UMUM }}</div>
                                <div>
                                    {{ $item->instruktur->NAMA_INSTRUKTUR }}</div>
                                <div>({{ $item->STATUS_JADWAL_HARIAN }})</div>
                                <div class="d-flex align-content-center justify-content-center">
                                    <a class="btn btn-secondary"
                                        href="{{ url('/editPageJadwalHarian/' . $item->TANGGAL_JADWAL_HARIAN) }}">
                                        <span class="glyphicon glyphicon-edit"></span> Edit
                                    </a>
                                </div>
                            </td>
                            @endif
                            @endforeach
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
