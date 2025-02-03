@extends('layouts.app') {{-- memanggil layout app.blade.php untuk menggabungkan konten --}}

{{-- mengabunggakan ke dalam yield content --}}
@section('content')
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf {{-- token csrf --}}
                            @method('PUT') {{-- method PUT --}}

                            {{-- Field untuk Gambar --}}
                            <div class="form-group">
                                <label class="font-weight-bold">Image</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                    name="image" value="{{ old('image', $post->image) }}">

                                <!-- error message untuk image -->
                                @error('image')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Field untuk Title --}}
                            <div class="form-group">
                                <label class="font-weight-bold">Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    name="title" value="{{ old('title', $post->title) }}"
                                    placeholder="Masukkan Judul Post">

                                <!-- error message untuk title -->
                                @error('title')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Field untuk Content --}}
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

                            {{-- Button UPDATE --}}
                            <button type="submit" class="btn btn-md btn-primary">UPDATE</button>

                            {{-- Button RESET --}}
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
