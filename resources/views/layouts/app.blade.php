<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- mengambil variable $title dari controller dan menggabungkan dengan config('app.name') --}}
    <title>{{ $title }} - {{ config('app.name') }}</title>

    {{-- import bootstrap cdn --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    {{-- import toastr cdn --}}
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body class="bg-light"> {{-- class bg-light diambil dari bootstrap --}}

    <div class="container mt-5"> {{-- class container diambil dari bootstrap dan class mt-5 untuk margin-top --}}
        <div class="row"> {{-- membuat baris --}}
            <div class="col-md-12"> {{-- membuat 12 kolom dengan ukuran md --}}
                <div class="card border-0 shadow rounded"> {{-- membuat card tanpa border, menambahkan shadow dan rounded --}}
                    @yield('content') {{-- menampilkan konten --}}
                </div>
            </div>
        </div>
    </div>

    {{-- Import jQuery CDN --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    {{-- Import Bootstrap JS CDN --}}
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    {{-- Import toastr JS CDN --}}
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</body>

</html>
