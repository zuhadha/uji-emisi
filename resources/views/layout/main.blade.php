<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet"
        type='text/css'>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" href="{!! asset('img/logo_ujiemisi_32x32_rounded.png') !!}" />

    <title>UJI EMISI</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/467dee4ab4.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        @include('partials.sidebar')
        <!-- Main Component -->
        <div class="main">

            <nav class="navbar navbar-light bg-light">
                <div class="container-fluid pe-5">
                    <button class="btn" type="button" data-bs-theme="light">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <form class="d-flex">
                        {{-- <div class="btn pe-4"><i class="fa-regular fa-building bengkel-icon py-0"></i></div> --}}
                        <div class="row-lg-12">
                            <div class="mt-2 row-lg-12">
                                <p class="m-0 mb-2 h2">{{ $bengkel_name }} | <span
                                        class="m-0 mb-1 pb-1 h4">{{ $perusahaan_name }}</span></p>
                            </div>
                            {{-- <div class="my-2">@yield('nama-perusahaan')</div> --}}
                            {{-- <div class=""><p class="m-0 mb-1 h4">Toyota Astra</p></div> --}}

                        </div>
                    </form>
                </div>
            </nav>

            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="container mb-3">
                        @yield('container')
                    </div>
                </div>
            </main>
        </div>
    </div>

    {{-- <script src="{{ asset('https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    @stack('js')
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
