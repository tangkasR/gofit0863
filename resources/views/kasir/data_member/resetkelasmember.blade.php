@extends('dashboard')
@section('container')
    <div class="p-2" style="margin-left:-10%;width:112%;background-color: #ABD9FF">
        <h1 style="margin-left: 10%;color:#ECF9FF">Data Member</h1>
        <h5 style="margin-left: 10%;color:#ECF9FF">Tabel Reset Kelas Member</h5>
    </div>

    <form action="{{ url('/resetKelasMember') }}" class="mt-3">
        <button type="submit" class="btn btn-info">Reset Kelas</button>
    </form>


    <div class="table-responsive mt-3">
        <table class="table table-striped table-sm">
            <thead style="background-color:#99E1E5;color:#FFFBEB">

                <div class="mt-2">
                    <tr class="text-center">
                        <th scope="col">Id</th>
                        <th scope="col">Id Member</th>
                        <th scope="col">Id Kelas</th>
                        <th scope="col">Sisa Deposit Kelas</th>
                        <th scope="col">Masa Berlaku</th>
                        <th scope="col">Masa Expired Reset Kelas</th>
                    </tr>
                </div>
            </thead>
            <tbody style="background-color:#ECF9FF">
                @foreach ($member as $items)
                    <tr class="text-center">
                        <td>{{ $items->ID }}</td>
                        <td>{{ $items->ID_MEMBER }}</td>
                        <td>{{ $items->ID_KELAS }}</td>
                        <td>{{ $items->SISA_DEPOSIT_KELAS }}</td>
                        <td>
                            @if ($items->MASA_BERLAKU != null)
                                {{ $items->MASA_BERLAKU }}
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $items->MASA_EXPIRED_RESET }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="p-2 mt-5" style="margin-left:-10%;width:112%;background-color: #ABD9FF">
        <h5 style="margin-left: 10%;color:#ECF9FF">Tabel Setelah Reset Kelas Member</h5>
    </div>
    <div class="table-responsive mt-3">
        <table class="table table-striped table-sm">
            <thead style="background-color:#99E1E5;color:#FFFBEB">

                <div class="mt-2">
                    <tr class="text-center">
                        <th scope="col">Id</th>
                        <th scope="col">Id Member</th>
                        <th scope="col">Id Kelas</th>
                        <th scope="col">Sisa Deposit Kelas</th>
                        <th scope="col">Masa Berlaku</th>
                        <th scope="col">Masa Expired Reset Kelas</th>
                    </tr>
                </div>
            </thead>
            <tbody style="background-color:#ECF9FF">
                @foreach ($member_after as $items)
                    <tr class="text-center">
                        <td>{{ $items->ID }}</td>
                        <td>{{ $items->ID_MEMBER }}</td>
                        <td>{{ $items->ID_KELAS }}</td>
                        <td>{{ $items->SISA_DEPOSIT_KELAS }}</td>
                        <td>
                            @if ($items->MASA_BERLAKU != null)
                                {{ $items->MASA_BERLAKU }}
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $items->MASA_EXPIRED_RESET }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
