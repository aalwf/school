@extends('layouts.app') {{-- memanggil layout app.blade.php untuk menggabungkan konten --}}

{{-- mengabunggakan ke dalam yield content --}}
@section('content')
    {{-- Header --}}
    <div>
        <h3 class="text-center my-4">Tutorial Laravel 10 untuk Pemula</h3>
        <h5 class="text-center">By <a href="https://github.com/aalwf">Alwafey</a></h5>
        <hr>
    </div>

    {{-- Membuat Card --}}
    <div class="card border-0 shadow-sm rounded">
        {{-- Membuat Card Body --}}
        <div class="card-body">
            <a href="{{ route('posts.create') }}" class="btn btn-md btn-success mb-3">Add Post</a>
            <table class="table table-bordered">
                {{-- Table Header --}}
                <thead>
                    <tr> {{-- Baris --}}
                        <th scope="col">Image</th>
                        <th scope="col">Title</th>
                        <th scope="col">Content</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>

                {{-- Table Body --}}
                <tbody>
                    {{-- Menampilkan data posts yang dikirim dari controller --}}
                    @forelse ($posts as $post)
                        <tr>
                            <td class="text-center">
                                <img src="{{ asset('/storage/posts/' . $post->image) }}" class="rounded"
                                    style="width: 150px">
                            </td>
                            <td>{{ $post->title }}</td>
                            <td>{!! $post->content !!}</td>
                            <td class="text-center">
                                <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                    action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-sm btn-dark">SHOW</a>
                                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        {{-- jika tidak ada data, maka akan menampilkan alert --}}
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

    <script>
        // menampilkan pesan toastr dari session
        @if (session()->has('success'))
            toastr.success('{{ session('success') }}', 'BERHASIL!');
        @elseif (session()->has('error'))
            toastr.error('{{ session('error') }}', 'GAGAL!');
        @endif
    </script>
@endsection
