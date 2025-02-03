@extends('layouts.app') {{-- memanggil layout app.blade.php untuk menggabungkan konten --}}

@section('content')
    {{-- mengabunggakan ke dalam yield content --}}
    <div class="row"> {{-- membuat baris --}}
        <div class="col-md-12"> {{-- membuat 12 kolom dengan ukuran md --}}
            <div class="card border-0 shadow rounded"> {{-- membuat card tanpa border, menambahkan shadow dan rounded --}}
                <div class="card-body"> {{-- membuat card body --}}
                    {{-- membuat tombol tambah post --}}
                    <a href="{{ route('posts.create') }}" class="btn btn-md btn-success mb-3">Add Post</a>
                    <table class="table table-bordered"> {{-- membuat tabel dengan border dan membuat tabel responsive --}}
                        <thead> {{-- membuat header tabel --}}
                            <tr> {{-- membuat baris pada header --}}
                                {{-- membuat kolom --}}
                                <th scope="col">GAMBAR</th>
                                <th scope="col">JUDUL</th>
                                <th scope="col">CONTENT</th>
                                <th scope="col">AKSI</th>
                            </tr>
                        </thead>

                        {{-- membuat isi tabel --}}
                        <tbody>
                            {{-- menampilkan data posts yang dikirim dari controller --}}
                            @forelse ($posts as $post)
                                <tr>
                                    <td class="text-center">
                                        <img src="{{ Storage::url('public/posts/') . $post->image }}" class="rounded"
                                            style="width: 150px">
                                    </td>
                                    <td>{{ $post->title }}</td>
                                    <td>{!! $post->content !!}</td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                            action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                            <a href="{{ route('posts.edit', $post->id) }}"
                                                class="btn btn-sm btn-primary">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                                {{-- jika tidak ada data, maka akan menampilkan alert --}}
                            @empty
                                <div class="alert alert-danger">
                                    Data Post belum Tersedia.
                                </div>
                            @endforelse
                        </tbody>
                    </table>

                    {{-- menampilkan link pagination --}}
                    {{ $posts->links() }}
                </div>
            </div>
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
