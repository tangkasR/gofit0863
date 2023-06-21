@extends('dashboard')
@section('container')
    <div class="p-2" style="margin-left:-10%;width:112%;background-color: #ABD9FF">
        <h1 style="margin-left: 10%;color:#ECF9FF">Reset Keterlambatan Instruktur</h1>
    </div>
    <div class="mt-3">
        <a href="{{ url('/resetTerlambat') }}" class="btn shadow rounded" style="background-color: #3AB4F2;color:#FFFBEB">
            Reset Instruktur</a>
    </div>

    <div class="table-responsive shadow-lg p-0 mb-5 rounded mt-3">
        <table class="table table-striped table-sm text-center">
            <thead class="" style="background-color:#99E1E5;color:#FFFBEB">
                <tr>
                    <th scope="col">Nama</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">No Telepon</th>
                    <th scope="col">Umur</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Jumlah Terlambat</th>

                </tr>
            </thead>
            <tbody style="background-color:#ECF9FF">
                @foreach ($instruktur as $items)
                    <tr>
                        <td>{{ $items->NAMA_INSTRUKTUR }}</td>
                        <td>{{ $items->ALAMAT_INSTRUKTUR }}</td>
                        <td>{{ $items->NO_TELEPON_INSTRUKTUR }}</td>
                        <td>{{ $items->UMUR_INSTRUKTUR }}</td>
                        <td>{{ $items->JENIS_KELAMIN_INSTRUKTUR }}</td>
                        @if ($items->JUMLAH_TERLAMBAT != null || $items->JUMLAH_TERLAMBAT != 0)
                            <td class="col">{{ $items->JUMLAH_TERLAMBAT }}</td>
                        @else
                            <td class="col">0</td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
