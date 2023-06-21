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
            <div class="form-box" style="height: 500px; width: 500px">
                <div class="form-value">
                    <div action="">
                        <form action=" {{ url('/ubahPasswordPegawai') }}" method="post">
                            @csrf
                            <h2>
                                Ubah Password
                            </h2>
                            <div class="inputbox">
                                <ion-icon name="mail-outline"></ion-icon>
                                <input class="@error('email') is-invalid @enderror" type="email" name="email"
                                    id="email" required>
                                <label for="email">Email</label>
                            </div>
                            <div class="inputbox">
                                <ion-icon name="lock-closed-outline"></ion-icon>
                                <input type="password" name="password" id="password" required>
                                <label for="password">Password</label>
                            </div>
                            <div class="inputbox">
                                <ion-icon name="lock-closed-outline"></ion-icon>
                                <input type="repassword" name="repassword" id="repassword" required>
                                <label for="repassword">Konfirmasi Password</label>
                            </div>
                            <button type="submit">Ubah</button>
                        </form>
                        <div class="mt-3">
                            <a href="{{ url('/') }}">Balik ke login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>
