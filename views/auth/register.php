<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register | Perpustakaan</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: #0b1f3a;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            border-radius: 15px;
            border: none;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
       <div class="col-11 col-sm-9 col-md-6 col-lg-5">

            <div class="card shadow-lg">
                <div class="card-body p-4">
                    <h4 class="text-center mb-4 fw-bold fs-5 fs-md-4">
                        <i class="bi bi-person-plus"></i> Registrasi
                    </h4>

                    <form method="POST" action="index.php?url=register">

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <button class="btn btn-primary w-100">
                            Daftar
                        </button>
                    </form>

                    <div class="text-center mt-3">
                        <small>Sudah punya akun?</small><br>
                        <a href="index.php?url=login">Login</a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
