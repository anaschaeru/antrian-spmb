<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Nomor Antrian SPMB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap5.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>

<body class="inter-regular">
    <div class="container">
        @yield('content')
    </div>
    <footer class="text-center text-lg-start bg-light text-muted mt-5">
        <div class="text-center p-4">
            © 2025 Copyright:
            <a class="text-reset fw-bold text-decoration-none" href="https://smkn4-tng.sch.id/" target="_blank">SMKN 4
                TANGERANG</a>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/jquery-3.7.1.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap5.js') }}"></script>
    <script>
        new DataTable('#example');
    </script>
    <script>
        new DataTable('#tableMinatBakat');
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success_nomor') && session('success_tanggal'))
        <script>
            Swal.fire({
                title: 'Berhasil!',
                html: 'Nomor Antrian:<h1>{{ session('success_nomor') }}</h1>' +
                    'Tanggal Penyerahan Berkas:<h1>{{ session('success_tanggal') }}</h1>' +
                    'Pukul. 08.00 WIB s.d. 14.00 WIB' +
                    '<br>Silakan cetak tiket antrian Anda.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = '/';
            });
        </script>
    @endif

    @if (session('success_update'))
        <script>
            Swal.fire({
                title: 'Berhasil!',
                text: "{{ session('success_update') }}",
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                title: 'Gagal!',
                text: "{{ session('error') }}",
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    <script>
        function validateToken(id) {
            let tokenInput = document.getElementById('token' + id).value;
            let correctToken = "048025";

            if (tokenInput !== correctToken) {
                Swal.fire({
                    title: 'Gagal!',
                    text: 'Token tidak valid, silakan coba lagi!',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            } else {
                document.getElementById('updateForm' + id).submit();
            }
        }
    </script>

</body>

</html>
