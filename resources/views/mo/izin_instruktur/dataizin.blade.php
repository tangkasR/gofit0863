@extends('dashboard')
@section('container')
    <div class="p-2" style="margin-left:-10%;width:112%;background-color: #ABD9FF">
        <h1 style="margin-left: 10%;color:#ECF9FF">Data Izin Instruktur</h1>
    </div>

    <div class="table-responsive mt-3">
        <table class="table table-striped table-sm">
            <thead style="background-color:#99E1E5;color:#FFFBEB">

                <div class="mt-2">
                    <tr class="text-center">
                        <th scope="col">Id Izin Instruktur</th>
                        <th scope="col">Nama Instruktur</th>
                        <th scope="col">Tanggal Izin Instruktur</th>
                        <th scope="col">Keterangan Izin</th>
                        <th scope="col">Tanggal Mengirim Izin</th>
                        <th scope="col">Status Izin</th>
                        <th scope="col">Tanggal Konfirmasi Izin</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </div>
            </thead>
            <tbody style="background-color:#ECF9FF">
                @foreach ($izinInstruktur as $items)
                    <tr class="text-center">
                        <td>{{ $items->ID_IZIN_INSTRUKTUR }}</td>
                        <td>{{ $items->instruktur->NAMA_INSTRUKTUR }}</td>
                        <td>{{ $items->TANGGAL_IZIN_INSTRUKTUR }}</td>
                        <td>{{ $items->KETERANGAN_IZIN }}</td>
                        <td>{{ $items->TANGGAL_MELAKUKAN_IZIN }}</td>
                        <td>{{ $items->STATUS_IZIN }}</td>
                        <td>{{ $items->TANGGAL_KONFIRMASI_IZIN }}</td>
                        <td>
                            <a style="background-color: #5BC0F8;color:#FFFBEB" class='btn btn-info'
                                href="{{ url('/konfirmasiIzin/' . $items->ID_IZIN_INSTRUKTUR) }}">
                                <span class="glyphicon glyphicon-edit"></span> Konfirmasi
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
