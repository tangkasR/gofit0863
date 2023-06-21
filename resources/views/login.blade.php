<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="..\css\index.css" rel="stylesheet">

    <title>Go Fit</title>
</head>

<body>

    <section>
        <div class="form">
            <div class="form-box" style="height: 400px; width: 400px">
                <div class="form-value">
                    <div action="">
                        <form action=" {{ url('/login') }}" method="post">
                            @csrf
                            <h2>
                                Login
                            </h2>
                            <div class="inputbox">
                                <ion-icon name="mail-outline"></ion-icon>
                                <input class="@error('EMAIL_PEGAWAI') is-invalid @enderror" type="email"
                                    name="EMAIL_PEGAWAI" id="EMAIL_PEGAWAI" value="{{ old('EMAIL_PEGAWAI') }}">
                                <label for="EMAIL_PEGAWAI">Email</label>
                            </div>
                            <div class="inputbox">
                                <ion-icon name="lock-closed-outline"></ion-icon>
                                <input type="password" name="password" id="password">
                                <label for="password">Password</label>
                            </div>
                            <button type="submit">Masuk</button>
                        </form>
                    </div>
                    <a href="{{ url('/indexGantiPassword') }}">Ganti password</a>
                    <div>
                        @include('message')
                        @if (Session::get('success'))
                            <div class="alert alert-success alert-dismissible animate_animated animate_fadeInDown no-print"style="width: fit-content; position:sticky"
                                role="alert">
                                {{ Session::get('success') }}
                                {{-- <button type="submit" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
                            </div>
                        @endif
                        @if (Session::get('error'))
                            <div class="alert alert-danger alert-dismissible animate_animated animate_fadeInDown no-print"
                                style="width: fit-content; position:sticky" role="alert">
                                {{ Session::get('error') }}
                                {{-- <button type="submit" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>
