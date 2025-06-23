<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Antrian SPMB SMKN 4 Tangerang</title>

    <!-- Combined and optimized CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <!-- Preconnect for Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Font loading with font-display: swap -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" media="print" onload="this.media='all'">
</head>

<body class="inter-regular">
    <div class="container">
        @yield('content')
    </div>

    <footer class="text-center text-lg-start bg-light text-muted mt-5">
        <div class="text-center p-4">
            © 2025 Copyright:
            <a class="text-reset fw-bold text-decoration-none" href="https://smkn4-tng.sch.id/" target="_blank"
                rel="noopener">SMKN 4 TANGERANG</a>
        </div>
    </footer>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/jquery-3.7.1.js') }}"></script>
    <script src="{{ asset('js/dataTables.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap5.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        new DataTable('#tableMinatBakat', {
            perPage: 10,
            perPageSelect: [10, 25, 50, 100],
            searchable: true,
            sortable: true,
            labels: {
                placeholder: 'Cari...',
                perPage: '{select} baris per halaman',
                noRows: 'Tidak ada data yang ditemukan',
                info: 'Menampilkan {start} sampai {end} dari {rows} baris',
            },
        });
    </script>

    <!-- Session messages handling -->
    <script>
        @if (session('success_nomor') && session('success_tanggal'))
            Swal.fire({
                title: 'Berhasil!',
                html: `Nomor Antrian:<h1>{{ session('success_nomor') }}</h1>
                      Tanggal Penyerahan Berkas:<h1>{{ session('success_tanggal') }}</h1>
                      Pukul. 08.00 WIB s.d. 14.00 WIB<br>
                      Silakan cetak tiket antrian Anda.`,
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = '/';
            });
        @endif

        @foreach (['success_update', 'success-login', 'success'] as $type)
            @if (session($type))
                Swal.fire({
                    title: 'Berhasil!',
                    text: "{{ session($type) }}",
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            @endif
        @endforeach

        @if (session('error'))
            Swal.fire({
                title: 'Gagal!',
                text: "{{ session('error') }}",
                icon: 'error',
                confirmButtonText: 'OK'
            });
        @endif
    </script>
    <script>
        $(document).ready(function() {
            $('.btn-group-toggle').on('click', '.btn', function() {
                $(this).addClass('active').siblings().removeClass('active');
            });
        });
    </script>

    <script>
        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
            });
        @endif

        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Gagal membuat Antrian!!!',
                html: `
                <ul class="text-left">
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </ul>
            `,
            });
        @endif
    </script>

</body>

</html>
