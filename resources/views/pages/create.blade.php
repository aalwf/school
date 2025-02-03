@extends('layouts.app') {{-- memanggil layout app.blade.php untuk menggabungkan konten --}}

@section('content')
    {{-- Membuat Card --}}
    <div class="card border-0 shadow-sm rounded">
        {{-- Card Body --}}
        <div class="card-body">
            {{-- form untuk tambah post --}}
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf {{-- token csrf --}}

                {{-- Field untuk Gambar --}}
                <div class="form-group">
                    <label class="font-weight-bold">Image</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">

                    <!-- error message untuk title -->
                    @error('image')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Field untuk Title --}}
                <div class="form-group">
                    <label class="font-weight-bold">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                        value="{{ old('title') }}" placeholder="Masukkan Judul Post">

                    <!-- error message untuk title -->
                    @error('title')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Field untuk Konten --}}
                <div class="form-group">
                    <label class="font-weight-bold">Content</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" name="content" rows="5"
                        placeholder="Masukkan Konten Post">{{ old('content') }}</textarea>

                    <!-- error message untuk content -->
                    @error('content')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Button SIMPAN --}}
                <button type="submit" class="btn btn-md btn-primary">SAVE</button>

                {{-- Button RESET --}}
                <button type="reset" class="btn btn-md btn-warning">RESET</button>

            </form>
        </div>
    </div>

    {{-- script untuk ckeditor --}}
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection
