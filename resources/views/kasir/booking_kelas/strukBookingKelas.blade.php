@extends('dashboard')
@section('container')
    <div class="card p-3 mt-3" style="width: 50%; height: 50%;">
        <div class="card-body p-3 bg-white">
            <h5>STRUK PRESENSI KELAS</h5>
            <div class="d-flex justify-content-between align-items-center">
                <h5>GoFit</h5>
                <div>
                    No Struk: {{ $strukBookingReguler->KODE_BOOKING_KELAS }}
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                Jl. Centralpark No. 10 Yogyakarta
                @if ($strukBookingReguler->WAKTU_PRESENSI_KELAS != null)
                    <div>
                        Tanggal :
                        {{ \Carbon\Carbon::parse($strukBookingReguler->WAKTU_PRESENSI_KELAS)->format('d/m/Y H:i:s') }}
                    </div>
                @else
                    <div>
                        Tanggal : Belum dikonfirmasi
                    </div>
                @endif
            </div>
            <div>
                Member : {{ $strukBookingReguler->ID_MEMBER }} / {{ $strukBookingReguler->NAMA_MEMBER }}
            </div>
            <div>Kelas : {{ $strukBookingReguler->NAMA_KELAS }}
            </div>
            <div>
                Instruktur : {{ $strukBookingReguler->NAMA_INSTRUKTUR }}
            </div>
            @if ($strukBookingReguler->TARIF_KELAS != 1)
                <div>
                    Tarif : Rp.{{ $strukBookingReguler->TARIF_KELAS }}
                </div>
                <div>
                    Sisa deposit : Rp.{{ $strukBookingReguler->SISA_DEPOSIT_UANG }}
                </div>
            @else
                <div>
                    Sisa Deposit: {{ $strukBookingPaket->SISA_DEPOSIT_KELAS }}
                </div>
                <div>
                    Berlaku Sampai: {{ \Carbon\Carbon::parse($strukBookingPaket->MASA_BERLAKU)->format('d/m/Y H:i:s') }}
                </div>
            @endif
            <script type="text/javascript">
                window.print();
            </script>
        </div>
    </div>
    {{-- <section>
        <div class="card my-3 p-3 bg-body rounded shadow-sm mx-auto"style="width: 35rem;">
            <div class="card-content">
                <h3>GoFit</h3>
                <p>Jl. Centralpark No.101 Yogyakarta</p>

                <hr style="width: 100%; color: black; height: 1px; background-color:black;" />
                <h3>STRUK PRESENSI KELAS</h3>
                <p>No Struk: {{ $strukBookingReguler->KODE_BOOKING_KELAS }} </p>
                @if ($strukBookingReguler->WAKTU_PRESENSI_KELAS != null)
                    <p>Tanggal :
                        {{ \Carbon\Carbon::parse($strukBookingReguler->WAKTU_PRESENSI_KELAS)->format('d/m/Y H:i:s') }}
                    </p>
                @else
                    <p>Tanggal : Belum dikonfirmasi </p>
                @endif

                <hr style="width: 100%; color: black; height: 1px; background-color:black;" />
                <p>Member : {{ $strukBookingReguler->ID_MEMBER }} / {{ $strukBookingReguler->NAMA_MEMBER }}</p>
                <p>Kelas : {{ $strukBookingReguler->NAMA_KELAS }}</p>
                <p>Instruktur : {{ $strukBookingReguler->NAMA_INSTRUKTUR }}</p>
                @if ($strukBookingReguler->TARIF_KELAS != 1)
                    <p>Tarif : Rp.{{ $strukBookingReguler->TARIF_KELAS }}</p>
                    <p>Sisa deposit : Rp.{{ $strukBookingReguler->SISA_DEPOSIT_UANG }}</p>
                @else
                    <p>Sisa Deposit: {{ $strukBookingPaket->SISA_DEPOSIT_KELAS }}x</p>
                    <p>Berlaku Sampai: {{ \Carbon\Carbon::parse($strukBookingPaket->MASA_BERLAKU)->format('d/m/Y H:i:s') }}
                    </p>
                @endif


            </div>
        </div>
    </section>
    <script type="text/javascript">
        window.print();
    </script> --}}
@endsection
