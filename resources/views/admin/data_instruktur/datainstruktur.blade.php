@extends('dashboard')
@section('container')
    <div class="p-2" style="margin-left:-10%;width:112%;background-color: #ABD9FF">
        <h1 style="margin-left: 10%;color:#ECF9FF">Data Instruktur</h1>
    </div>
    <div class="d-flex align-items-center justify-content-between">
        <div class="mt-4 mb-4" style="width:80%">
            <form action="{{ url('/searchInstruktur') }}" class=" navbar-search" method="get">
                <div class="d-flex align-items-center">
                    <div class="bg-white rounded ms-2">

                        <button class="btn btn-info" type="submit" style="color:white">
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

        <div class="shadow p-0 rounded rounded" style="position: relative; text:right">
            <a href="{{ url('/addPageInstruktur') }}" class="btn btn-info" style="color:white"><b>+</b> Tambah
                Instruktur</a>
        </div>
    </div>
    <div class="table-responsive shadow-lg p-0 mb-5 rounded">
        <table class="table table-striped table-sm text-center">
            <thead class="" style="background-color:#99E1E5;color:#FFFBEB">
                <tr>
                    <th scope="col">Nama</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">No Telepon</th>
                    <th scope="col">Umur</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Tanggal Lahir</th>
                    <th scope="col">Aksi</th>

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
                        <td>{{ $items->TANGGAL_LAHIR_INSTRUKTUR }}</td>
                        <td>
                            <form form onsubmit="return confirm('Are you sure?');"
                                action="{{ url('/deleteInstruktur/' . $items->ID_INSTRUKTUR) }}" method="POST">
                                <a style="color:white" class="btn btn-dark"
                                    href="{{ url('/editPageInstruktur/' . $items->ID_INSTRUKTUR) }}">
                                    <span class="glyphicon glyphicon-edit"></span> Edit
                                </a>
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">
                                    <span class="glyphicon glyphicon-remove"></span> Del
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
