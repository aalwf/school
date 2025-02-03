@extends('layouts.app')

@section('content')
    <div class="card-body"> {{-- membuat card body --}}
        {{-- form untuk tambah post --}}
        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf {{-- token csrf --}}
            @method('PUT') {{-- mengubah method ke put --}}

            {{-- field untuk gambar --}}
            <div class="form-group">
                <label class="font-weight-bold">Image</label>
                <input type="file" class="form-control" name="image">
            </div>

            {{-- field untuk judul --}}
            <div class="form-group">
                <label class="font-weight-bold">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                    value="{{ old('title', $post->title) }}" placeholder="Masukkan Judul Post">

                <!-- error message untuk title -->
                @error('title')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- field untuk konten --}}
            <div class="form-group">
                <label class="font-weight-bold">Content</label>
                <textarea class="form-control @error('content') is-invalid @enderror" name="content" rows="5"
                    placeholder="Masukkan Konten Post">{{ old('content', $post->content) }}</textarea>

                <!-- error message untuk content -->
                @error('content')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- tombol simpan --}}
            <button type="submit" class="btn btn-md btn-primary">UPDATE</button>

            {{-- tombol reset --}}
            <button type="reset" class="btn btn-md btn-warning">RESET</button>
        </form>
    </div>

    {{-- script untuk ckeditor --}}
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection
