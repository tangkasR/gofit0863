@extends('dashboard')
@section('container')
    <div class="p-2" style="margin-left:-10%;width:112%;background-color: #ABD9FF">
        <h1 style="margin-left: 10%;color:#ECF9FF">Data Member</h1>
        <h5 style="margin-left: 10%;color:#ECF9FF">Deaktivasi Member</h5>
    </div>
    <div class="mt-3">
        <form action="{{ url('/deaktivasiMember') }}">
            <button type="submit" class="btn btn-info">Deaktivasi</button>
        </form>
    </div>

    <div class="table-responsive mt-3">
        <table class="table table-striped table-sm">
            <thead style="background-color:#99E1E5;color:#FFFBEB">

                <div class="mt-2">
                    <tr class="text-center">
                        <th scope="col">Id Member</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">No Telepon</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Masa Aktivasi</th>
                        <th scope="col">Sisa Deposit Kelas</th>
                        <th scope="col">Sisa Deposit uang</th>
                        <th scope="col">Tanggal Lahir</th>
                    </tr>
                </div>
            </thead>
            <tbody style="background-color:#ECF9FF">
                @foreach ($member as $items)
                    <tr>
                        <td>{{ $items->ID_MEMBER }}</td>
                        <td>{{ $items->NAMA_MEMBER }}</td>
                        <td>{{ $items->ALAMAT_MEMBER }}</td>
                        <td>{{ $items->TELEPON_MEMBER }}</td>
                        <td>{{ $items->JENIS_KELAMIN_MEMBER }}</td>
                        <td>{{ $items->MASA_AKTIVASI }}</td>
                        <td>{{ $items->SISA_DEPOSIT_KELAS }}</td>
                        <td>{{ $items->SISA_DEPOSIT_UANG }}</td>
                        <td>{{ $items->TANGGAL_LAHIR_MEMBER }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
