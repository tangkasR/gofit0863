<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="..\css\index.css" rel="stylesheet" >
    <title>Go Fit</title>
</head>

<body>
    <section>
        <div class="form-regis">
            <div class="form-box">
                <div class="form-value">
                    <form action="/register" method="post">
                        @csrf
                        <h2>
                            Register
                        </h2>
                        <div class="inputbox">
                            <ion-icon name="person-outline"></ion-icon>
                            <input type="text" name="NAMA_PEGAWAI" id="NAMA_PEGAWAI" placeholder="Nama Pegawai">
                            <label for="NAMA_PEGAWAI">Nama Pegawai</label>
                        </div>
                        <div class="inputbox">
                            <ion-icon name="map-outline"></ion-icon>
                            <input type="text" name="ALAMAT_PEGAWAI" id="ALAMAT_PEGAWAI" placeholder="Alamat Pegawai">
                            <label for="ALAMAT_PEGAWAI">Alamat Pegawai</label>
                        </div>
                        <div class="inputbox">
                            <ion-icon name="mail-outline"></ion-icon>
                            <input type="email" name="EMAIL_PEGAWAI" id="EMAIL_PEGAWAI" placeholder="abcd@gmail.com">
                            <label for="EMAIL_PEGAWAI">Email</label>
                        </div>
                        <div class="inputbox">
                            <ion-icon name="lock-closed-outline"></ion-icon>
                            <input type="password" name="PASSWORD_PEGAWAI" id="PASSWORD_PEGAWAI" placeholder="*******">
                            <label for="PASSWORD_PEGAWAI">Password</label>
                        </div>
                        <div class="inputbox">
                            <ion-icon name="call-outline"></ion-icon>
                            <input type="text" name="ROLE_PEGAWAI" id="ROLE_PEGAWAI" placeholder="Role Pegawai">
                            <label for="ROLE_PEGAWAI">Role Pegawai</label>
                        </div>
                        <div class="inputbox">
                            <ion-icon name="call-outline"></ion-icon>
                            <input type="text" name="JENIS_KELAMIN_PEGAWAI" id="JENIS_KELAMIN_PEGAWAI" placeholder="Jenis Kelamin">
                            <label for="JENIS_KELAMIN_PEGAWAI">Jenis Kelamin</label>
                        </div>
                        <div class="inputbox">
                            <ion-icon name="call-outline"></ion-icon>
                            <input type="text" name="UMUR_PEGAWAI" id="UMUR_PEGAWAI" placeholder="Umur Pegawai">
                            <label for="UMUR_PEGAWAI">Umur Pegawai</label>
                        </div>
                        <button type="submit">Register</button>
                    </form>
                    <div class="p-5 mt-5 mb-5">
                        <p>Sudah Punya akun? <a href="/">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>