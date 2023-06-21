@extends('/dashboard')
@section('container')
    <div class="p-2" style="margin-left:-10%;width:112%;background-color: #ABD9FF">
        <h1 style="margin-left: 10%;color:#ECF9FF">Jadwal Umum</h1>
    </div>
    {{-- <div class="mt-3 mb-3 "> --}}
    <div class="mt-3 mb-3 ms-2">
        <a href="{{ url('/addPageJadwal') }}" class="btn btn-info shadow rounded" style="color:white"><b>+</b>
            Tambah Jadwal</a>
    </div>
    {{-- </div> --}}
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
                        <tr style="color:black">
                            <th class="align-middle" style="background-color: #8ED6FF">Senin</td>
                                @foreach ($jadwal as $item)
                                    @if ($item->HARI_JADWAL_UMUM == 'Senin')
                            <td style="font-family:sans-serif;font-size: 110%;font:bold">
                                <span>{{ $item->kelas->NAMA_KELAS }}</span>
                                <div>{{ $item->WAKTU_JADWAL_UMUM }}</div>
                                <div>
                                    {{ $item->instruktur->NAMA_INSTRUKTUR }}</div>
                                <div class="d-flex align-content-center justify-content-center">
                                    <a style="background-color: #5BC0F8;color:#FFFBEB;" class='btn btn-info btn-xs me-3'
                                        href="{{ url('/editPageJadwal/' . $item->ID_JADWAL_UMUM) }}">
                                        <span class="glyphicon glyphicon-edit"></span> Edit
                                    </a>
                                    <form form onsubmit="return confirm('Are you sure?');"
                                        action="{{ url('/deleteJadwal/' . $item->ID_JADWAL_UMUM) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-xs">
                                            <span class="glyphicon glyphicon-remove"></span> Del
                                        </button>

                                    </form>
                                </div>
                            </td>
                            @endif
                            @endforeach
                        </tr>
                        <tr style="color:black">
                            <th class="align-middle" style="background-color: #8ED6FF">Selasa</td>
                                @foreach ($jadwal as $item)
                                    @if ($item->HARI_JADWAL_UMUM == 'Selasa')
                            <td style="font-family:sans-serif;font-size: 110%;font:bold">
                                <span>{{ $item->kelas->NAMA_KELAS }}</span>
                                <div>{{ $item->WAKTU_JADWAL_UMUM }}</div>
                                <div>
                                    {{ $item->instruktur->NAMA_INSTRUKTUR }}</div>
                                <div class="d-flex align-content-center justify-content-center">
                                    <a style="background-color: #5BC0F8;color:#FFFBEB" class='btn btn-info btn-xs me-3'
                                        href="{{ url('/editPageJadwal/' . $item->ID_JADWAL_UMUM) }}">
                                        <span class="glyphicon glyphicon-edit"></span> Edit
                                    </a>
                                    <form form onsubmit="return confirm('Are you sure?');"
                                        action="{{ url('/deleteJadwal/' . $item->ID_JADWAL_UMUM) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-xs">
                                            <span class="glyphicon glyphicon-remove"></span> Del
                                        </button>

                                    </form>
                                </div>
                            </td>
                            @endif
                            @endforeach
                        </tr>
                        <tr style="color:black">
                            <th class="align-middle" style="background-color: #8ED6FF">Rabu</td>
                                @foreach ($jadwal as $item)
                                    @if ($item->HARI_JADWAL_UMUM == 'Rabu')
                            <td style="font-family:sans-serif;font-size: 110%;font:bold">
                                <span>{{ $item->kelas->NAMA_KELAS }}</span>
                                <div>{{ $item->WAKTU_JADWAL_UMUM }}</div>
                                <div>
                                    {{ $item->instruktur->NAMA_INSTRUKTUR }}</div>
                                <div class="d-flex align-content-center justify-content-center">
                                    <a style="background-color: #5BC0F8;color:#FFFBEB" class='btn btn-info btn-xs me-3'
                                        href="{{ url('/editPageJadwal/' . $item->ID_JADWAL_UMUM) }}">
                                        <span class="glyphicon glyphicon-edit"></span> Edit
                                    </a>
                                    <form form onsubmit="return confirm('Are you sure?');"
                                        action="{{ url('/deleteJadwal/' . $item->ID_JADWAL_UMUM) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-xs">
                                            <span class="glyphicon glyphicon-remove"></span> Del
                                        </button>

                                    </form>
                                </div>
                            </td>
                            @endif
                            @endforeach
                        </tr>
                        <tr style="color:black">
                            <th class="align-middle" style="background-color: #8ED6FF">Kamis</td>
                                @foreach ($jadwal as $item)
                                    @if ($item->HARI_JADWAL_UMUM == 'Kamis')
                            <td style="font-family:sans-serif;font-size: 110%;font:bold">
                                <span>{{ $item->kelas->NAMA_KELAS }}</span>
                                <div>{{ $item->WAKTU_JADWAL_UMUM }}</div>
                                <div>
                                    {{ $item->instruktur->NAMA_INSTRUKTUR }}</div>
                                <div class="d-flex align-content-center justify-content-center">
                                    <a style="background-color: #5BC0F8;color:#FFFBEB" class='btn btn-info btn-xs me-3'
                                        href="{{ url('/editPageJadwal/' . $item->ID_JADWAL_UMUM) }}">
                                        <span class="glyphicon glyphicon-edit"></span> Edit
                                    </a>
                                    <form form onsubmit="return confirm('Are you sure?');"
                                        action="{{ url('/deleteJadwal/' . $item->ID_JADWAL_UMUM) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-xs">
                                            <span class="glyphicon glyphicon-remove"></span> Del
                                        </button>

                                    </form>
                                </div>
                            </td>
                            @endif
                            @endforeach
                        </tr>
                        <tr style="color:black">
                            <th class="align-middle" style="background-color: #8ED6FF">Jumat</td>
                                @foreach ($jadwal as $item)
                                    @if ($item->HARI_JADWAL_UMUM == 'Jumat')
                            <td style="font-family:sans-serif;font-size: 110%;font:bold">
                                <span>{{ $item->kelas->NAMA_KELAS }}</span>
                                <div>{{ $item->WAKTU_JADWAL_UMUM }}</div>
                                <div>
                                    {{ $item->instruktur->NAMA_INSTRUKTUR }}</div>
                                <div class="d-flex align-content-center justify-content-center">
                                    <a style="background-color: #5BC0F8;color:#FFFBEB" class='btn btn-info btn-xs me-3'
                                        href="{{ url('/editPageJadwal/' . $item->ID_JADWAL_UMUM) }}">
                                        <span class="glyphicon glyphicon-edit"></span> Edit
                                    </a>
                                    <form form onsubmit="return confirm('Are you sure?');"
                                        action="{{ url('/deleteJadwal/' . $item->ID_JADWAL_UMUM) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-xs">
                                            <span class="glyphicon glyphicon-remove"></span> Del
                                        </button>

                                    </form>
                                </div>
                            </td>
                            @endif
                            @endforeach
                        </tr>
                        <tr style="color:black">
                            <th class="align-middle" style="background-color: #8ED6FF">Sabtu</td>
                                @foreach ($jadwal as $item)
                                    @if ($item->HARI_JADWAL_UMUM == 'Sabtu')
                            <td style="font-family:sans-serif;font-size: 110%;font:bold">
                                <span>{{ $item->kelas->NAMA_KELAS }}</span>
                                <div>{{ $item->WAKTU_JADWAL_UMUM }}</div>
                                <div>
                                    {{ $item->instruktur->NAMA_INSTRUKTUR }}</div>
                                <div class="d-flex align-content-center justify-content-center">
                                    <a style="background-color: #5BC0F8;color:#FFFBEB" class='btn btn-info btn-xs me-3'
                                        href="{{ url('/editPageJadwal/' . $item->ID_JADWAL_UMUM) }}">
                                        <span class="glyphicon glyphicon-edit"></span> Edit
                                    </a>
                                    <form form onsubmit="return confirm('Are you sure?');"
                                        action="{{ url('/deleteJadwal/' . $item->ID_JADWAL_UMUM) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-xs">
                                            <span class="glyphicon glyphicon-remove"></span> Del
                                        </button>

                                    </form>
                                </div>
                            </td>
                            @endif
                            @endforeach
                        </tr>
                        <tr style="color:black">
                            <th class="align-middle" style="background-color: #8ED6FF">Minggu</td>
                                @foreach ($jadwal as $item)
                                    @if ($item->HARI_JADWAL_UMUM == 'Minggu')
                            <td style="font-family:sans-serif;font-size: 110%;font:bold">
                                <span>{{ $item->kelas->NAMA_KELAS }}</span>
                                <div>{{ $item->WAKTU_JADWAL_UMUM }}</div>
                                <div>
                                    {{ $item->instruktur->NAMA_INSTRUKTUR }}</div>
                                <div class="d-flex align-content-center justify-content-center">
                                    <a style="background-color: #5BC0F8;color:#FFFBEB" class='btn btn-info btn-xs me-3'
                                        href="{{ url('/editPageJadwal/' . $item->ID_JADWAL_UMUM) }}">
                                        <span class="glyphicon glyphicon-edit"></span> Edit
                                    </a>
                                    <form form onsubmit="return confirm('Are you sure?');"
                                        action="{{ url('/deleteJadwal/' . $item->ID_JADWAL_UMUM) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-xs">
                                            <span class="glyphicon glyphicon-remove"></span> Del
                                        </button>

                                    </form>
                                </div>
                            </td>
                            @endif
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
