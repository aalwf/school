@extends('layouts.app')

@section('content')
    <div class="card-body"> {{-- membuat card body --}}
        {{-- form untuk tambah post --}}
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf {{-- token csrf --}}

            {{-- field untuk gambar --}}
            <div class="form-group">
                <label class="font-weight-bold">GAMBAR</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">

                <!-- error message untuk title -->
                @error('image')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- field untuk judul --}}
            <div class="form-group">
                <label class="font-weight-bold">JUDUL</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                    value="{{ old('title') }}" placeholder="Masukkan Judul Post">

                <!-- error message untuk title -->
                @error('title')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- field untuk konten --}}
            <div class="form-group">
                <label class="font-weight-bold">KONTEN</label>
                <textarea class="form-control @error('content') is-invalid @enderror" name="content" rows="5"
                    placeholder="Masukkan Konten Post">{{ old('content') }}</textarea>

                <!-- error message untuk content -->
                @error('content')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- tombol simpan --}}
            <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>

            {{-- tombol reset --}}
            <button type="reset" class="btn btn-md btn-warning">RESET</button>
        </form>
    </div>
@endsection
