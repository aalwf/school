<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Judul Halaman --}}
    <title>{{ $title }} - {{ config('app.name') }}</title>

    {{-- Bootstrap CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background: lightgray">


    <div class="container mt-5"> {{-- Pembungkus Konten --}}
        <div class="row"> {{-- Baris Konten --}}
            <div class="col-md-12"> {{-- Kolom Konten --}}
                @yield('content') {{-- Isi Konten --}}
            </div>
        </div>
    </div>

    {{-- Bootstrap CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    {{-- SweetAlert CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>
