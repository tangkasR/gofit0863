@extends('dashboard')
@section('container')
    <div class="p-2" style="margin-left:-10%;width:112%;background-color: #ABD9FF">
        <h1 style="margin-left: 10%;color:#ECF9FF">Data Member</h1>
    </div>
    <div class="d-flex align-items-center justify-content-between">
        <div class="mt-4 mb-4" style="width:80%">
            <form action="{{ url('/searchMember') }}" class=" navbar-search" method="get">
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
        <div class="shadow p-0 bg-white rounded">
            <div style="position: relative; text:right">
                <a href="{{ url('/addPageMember') }}" class="btn"
                    style="background-color: #3AB4F2;color:#FFFBEB"><b>+</b> Tambah Member</a>
            </div>

        </div>
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
                        <th scope="col" colspan="5">Aksi</th>
                    </tr>
                </div>
            </thead>
            <tbody style="background-color:#ECF9FF">
                @foreach ($member as $items)
                    <tr class="text-center">
                        <td>{{ $items->ID_MEMBER }}</td>
                        <td>{{ $items->NAMA_MEMBER }}</td>
                        <td>{{ $items->ALAMAT_MEMBER }}</td>
                        <td>{{ $items->TELEPON_MEMBER }}</td>
                        <td>{{ $items->JENIS_KELAMIN_MEMBER }}</td>
                        <td>{{ $items->MASA_AKTIVASI }}</td>
                        <td>{{ $items->SISA_DEPOSIT_KELAS }}</td>
                        <td>{{ $items->SISA_DEPOSIT_UANG }}</td>
                        <td>{{ $items->TANGGAL_LAHIR_MEMBER }}</td>
                        <td>
                            <a style="background-color: #5BC0F8;color:#FFFBEB" class='btn btn-info btn-xs'
                                href="{{ url('/editPageMember/' . $items->ID_MEMBER) }}">
                                <span class="glyphicon glyphicon-edit"></span> Edit
                            </a>
                        </td>
                        <td>
                            <form form onsubmit="return confirm('Are you sure?');"
                                action="{{ url('/deleteMember/' . $items->ID_MEMBER) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-xs">
                                    <span class="glyphicon glyphicon-remove"></span> Del
                                </button>

                            </form>
                        </td>
                        <td>
                            <a style="color:#FFFBEB" class='btn btn-info btn-xs'
                                href="{{ url('/cardMember/' . $items->ID_MEMBER) }}">
                                <span class="glyphicon glyphicon-edit"></span> Cetak Kartu
                            </a>
                        </td>
                        <td>
                            <a class='btn btn-dark btn-xs' href="{{ url('/reset_password/' . $items->ID_MEMBER) }}">
                                <span class="glyphicon glyphicon-edit"></span> Reset Password
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
