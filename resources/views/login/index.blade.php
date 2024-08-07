<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">
    <script src="https://kit.fontawesome.com/467dee4ab4.js" crossorigin="anonymous"></script>
</head>

<body>

    <div class="container-fluid">
        <img src="login_ilustration.jpg" alt="" class="background-image">
        <div class="row justify-content-center align-items-center h-100">
            <form class="login-form pb-2" action="/login" method="post">
                @csrf
                <div class="text-center mb-4">
                    <img src="/img/logo_ujiemisi_100x500-removebg.png" alt="Logo Asbekindo" style="max-width: 200px;">
                </div>

                {{-- <h4 class="text-center mb-2">Login</h4> --}}
                <div class="mb-3">
                    <label for="username" class="form-label mb-0">Username</label>
                    <input type="text" name="username" class="form-control" id="username" placeholder="Username"
                        autofocus required>
                </div>
                <div class="mb-2">
                    <label for="password" class="form-label mb-0">Password</label>
                    <div class="input-group">
                        <input type="password" name="password" class="form-control" id="password"
                            placeholder="Password" required>
                        <div class="input-group-text bg-transparent border-0" onclick="togglePassword()"
                            style="border-bottom: 1px solid black !important; border-radius: 0;">
                            <i class="fa fa-eye d-none"></i>
                            <i class="fa fa-eye-slash"></i>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-4">Login</button>
                <div class="text-center my-3">
                    <p>Didukung oleh:</p>
                    <img class="mx-1" src="/img/logo_dlh.png" alt="Logo Asbekindo" style="max-height: 50px;">
                    <img class="mx-1" src="/img/logo_dishub.png" alt="Logo Asbekindo" style="max-height: 50px;">
                    <img class="mx-1" src="/img/logo_asbekindo.png" alt="Logo Asbekindo" style="max-height: 50px;">
                </div>
            </form>
        </div>
    </div>

    <div id="notification-popup" class="notification-popup">
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session()->has('loginError'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('loginError') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePassword() {
            document.querySelector('.fa.fa-eye').classList.toggle('d-none');
            document.querySelector('.fa.fa-eye-slash').classList.toggle('d-none');
            const hide = document.querySelector('.fa.fa-eye').classList.contains('d-none');
            document.querySelector('#password').setAttribute('type', hide ? 'password' : 'text');
        }
    </script>
</body>

</html>
