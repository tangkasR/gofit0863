@extends('dashboard')
@section('container')
    <div class="card p-3 mt-3" style="width: 50%; height: 50%;">
        <div class="card-body p-3 bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <h5>GoFit</h5>
                <div>
                    No Struk: {{ $strukBookingGym->KODE_BOOKING_GYM }}
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                Jl. Centralpark No. 10 Yogyakarta
                <div>
                    Tanggal: {{ $strukBookingGym->TANGGAL_BOOKING_GYM }}
                </div>
            </div>
            <div class="mt-2">
                <h5>Member : {{ $strukBookingGym->ID_MEMBER }} / {{ $strukBookingGym->member->NAMA_MEMBER }}</h5>
            </div>
            <div>
                Slot Waktu : {{ $strukBookingGym->SLOT_WAKTU_GYM }}
            </div>
            <div>
                Status Presensi: {{ $strukBookingGym->STATUS_PRESENSI_GYM }}
            </div>
            <script type="text/javascript">
                window.print();
            </script>
        </div>
    </div>
@endsection
