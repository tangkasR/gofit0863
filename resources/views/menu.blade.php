@if ($pegawai->ROLE_PEGAWAI == 'kasir')
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link" style="color:#FFFBEB; background-color:#3AB4F2" aria-current="page"
                href="{{ url('member') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="align-text-bottom" viewBox="0 0 16 16">
                    <path
                        d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z" />
                </svg>
                Kelola Member
            </a>
        </li>
        <li class="nav-item mt-3">
            <a class="nav-link" style="color:#FFFBEB; background-color:#3AB4F2" aria-current="page"
                href="{{ url('/transaksiAktivasi') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="align-text-bottom" viewBox="0 0 16 16">
                    <path
                        d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z" />
                </svg>
                Transaksi Aktivasi
            </a>
        </li>
        <li class="nav-item mt-3">
            <a class="nav-link" style="color:#FFFBEB; background-color:#3AB4F2" aria-current="page"
                href="{{ url('/transaksiUang') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="align-text-bottom" viewBox="0 0 16 16">
                    <path
                        d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z" />
                </svg>
                Transaksi Deposit Uang
            </a>
        </li>
        <li class="nav-item mt-3">
            <a class="nav-link" style="color:#FFFBEB; background-color:#3AB4F2" aria-current="page"
                href="{{ url('/transaksiKelas') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="align-text-bottom" viewBox="0 0 16 16">
                    <path
                        d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z" />
                </svg>
                Transaksi Deposit Kelas
            </a>
        </li>
        <li class="nav-item mt-3">
            <a class="nav-link" style="color:#FFFBEB; background-color:#3AB4F2" aria-current="page"
                href="{{ url('/deaktivasiPage') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="align-text-bottom" viewBox="0 0 16 16">
                    <path
                        d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z" />
                </svg>
                Deaktivasi Member
            </a>
        </li>
        <li class="nav-item mt-3">
            <a class="nav-link" style="color:#FFFBEB; background-color:#3AB4F2" aria-current="page"
                href="{{ url('/resetKelasMemberPage') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="align-text-bottom" viewBox="0 0 16 16">
                    <path
                        d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z" />
                </svg>
                Reset Kelas Member
            </a>
        </li>
        <li class="nav-item mt-3">
            <a class="nav-link" style="color:#FFFBEB; background-color:#3AB4F2" aria-current="page"
                href="{{ url('resetTerlambatPage') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="align-text-bottom" viewBox="0 0 16 16">
                    <path
                        d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z" />
                </svg>
                Reset Terlambat Instruktur
            </a>
        </li>
        <li class="nav-item mt-3">
            <a class="nav-link" style="color:#FFFBEB; background-color:#3AB4F2" aria-current="page"
                href="{{ url('bookingKelas') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="align-text-bottom" viewBox="0 0 16 16">
                    <path
                        d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z" />
                </svg>
                Booking Kelas
            </a>
        </li>
        <li class="nav-item mt-3">
            <a class="nav-link" style="color:#FFFBEB; background-color:#3AB4F2" aria-current="page"
                href="{{ url('bookingGym') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="align-text-bottom" viewBox="0 0 16 16">
                    <path
                        d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z" />
                </svg>
                Booking Gym
            </a>
        </li>
    </ul>
@endif

@if ($pegawai->ROLE_PEGAWAI == 'manager operational')
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link" style="color:#FFFBEB; background-color:#3AB4F2" aria-current="page"
                href="{{ URL('/jadwal') }}">
                <span data-feather="file" class="align-text-bottom"></span>
                Kelola Jadwal Umum
            </a>
        </li>
        <li class="nav-item mt-3">
            <a class="nav-link" style="color:#FFFBEB; background-color:#3AB4F2" aria-current="page"
                href="{{ URL('/jadwalHarian') }}">
                <span data-feather="file" class="align-text-bottom"></span>
                Kelola Jadwal Harian
            </a>
        </li>
        <li class="nav-item mt-3">
            <a class="nav-link" style="color:#FFFBEB; background-color:#3AB4F2" aria-current="page"
                href="{{ URL('/izinInstruktur') }}">
                <span data-feather="file" class="align-text-bottom"></span>
                Konfirmasi Izin Instruktur
            </a>
        </li>
        <li class="nav-item mt-3">
            <a class="nav-link" style="color:#FFFBEB; background-color:#3AB4F2" aria-current="page"
                href="{{ URL('/indexLaporanPendapatan') }}">
                <span data-feather="file" class="align-text-bottom"></span>
                Laporan Pendapatan
            </a>
        </li>
        <li class="nav-item mt-3">
            <a class="nav-link" style="color:#FFFBEB; background-color:#3AB4F2" aria-current="page"
                href="{{ URL('/indexLaporanGym') }}">
                <span data-feather="file" class="align-text-bottom"></span>
                Laporan Gym
            </a>
        </li>
        <li class="nav-item mt-3">
            <a class="nav-link" style="color:#FFFBEB; background-color:#3AB4F2" aria-current="page"
                href="{{ URL('/indexLaporanKelas') }}">
                <span data-feather="file" class="align-text-bottom"></span>
                Laporan Kelas
            </a>
        </li>
        <li class="nav-item mt-3">
            <a class="nav-link" style="color:#FFFBEB; background-color:#3AB4F2" aria-current="page"
                href="{{ URL('/indexLaporanInstruktur') }}">
                <span data-feather="file" class="align-text-bottom"></span>
                Laporan Instruktur
            </a>
        </li>
    </ul>
@endif

@if ($pegawai->ROLE_PEGAWAI == 'admin')
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link" style="color:#FFFBEB; background-color:#3AB4F2" aria-current="page"
                href="{{ url('instruktur') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="align-text-bottom" viewBox="0 0 16 16">
                    <path
                        d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z" />
                </svg>
                Kelola Instruktur
            </a>
        </li>
    </ul>
@endif
