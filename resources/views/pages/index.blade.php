@extends('layouts.app') {{-- Menggunakan layout 'app' --}}

{{-- Konten halaman --}}
@section('content')
    {{-- Header --}}
    <div>
        <h3 class="text-center my-4">Tutorial Laravel 10 untuk Pemula</h3>
        <h5 class="text-center">By <a href="https://github.com/aalwf">Alwafey</a></h5>
        <hr>
    </div>

    {{-- Membuat Card --}}
    <div class="card border-0 shadow-sm rounded">
        {{-- Card Body --}}
        <div class="card-body">
            <a href="{{ route('products.create') }}" class="btn btn-md btn-success mb-3">ADD PRODUCT</a>
            {{-- Membuat Table --}}
            <table class="table table-bordered">
                {{-- Table Header --}}
                <thead>
                    <tr>
                        <th scope="col">IMAGE</th>
                        <th scope="col">TITLE</th>
                        <th scope="col">PRICE</th>
                        <th scope="col">STOCK</th>
                        <th scope="col" style="width: 20%">ACTIONS</th>
                    </tr>
                </thead>

                {{-- Table Body --}}
                <tbody>
                    {{-- Menampilkan data product yang dikirim dari controller --}}
                    @forelse ($products as $product)
                        <tr>
                            <td class="text-center">
                                <img src="{{ asset('/storage/products/' . $product->image) }}" class="rounded"
                                    style="width: 150px">
                            </td>
                            <td>{{ $product->title }}</td>
                            <td>{{ 'Rp ' . number_format($product->price, 2, ',', '.') }}</td>
                            <td>{{ $product->stock }}</td>
                            <td class="text-center">
                                <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                    action="{{ route('products.destroy', $product->id) }}" method="POST">
                                    <a href="{{ route('products.show', $product->id) }}"
                                        class="btn btn-sm btn-dark">SHOW</a>
                                    <a href="{{ route('products.edit', $product->id) }}"
                                        class="btn btn-sm btn-primary">EDIT</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        {{-- jika tidak ada data, maka akan menampilkan alert --}}
                        <div class="alert alert-danger">
                            Data Products belum Tersedia.
                        </div>
                    @endforelse
                </tbody>
            </table>

            {{-- menampilkan link pagination --}}
            {{ $posts->links() }}
        </div>
    </div>

    <script>
        // menampilkan pesan toastr dari session
        @if (session()->has('success'))
            toastr.success('{{ session('success') }}', 'BERHASIL!');
        @elseif (session()->has('error'))
            toastr.error('{{ session('error') }}', 'GAGAL!');
        @endif
    </script>
@endsection
