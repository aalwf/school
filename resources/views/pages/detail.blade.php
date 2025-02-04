@extends('layouts.app') {{-- Menggunakan layout 'app' --}}

@section('content')
    {{-- Konten halaman --}}
    <div class="row">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <img src="{{ asset('/storage/public/products/' . $product->image) }}" class="rounded" style="width: 100%">
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <h3>{{ $product->title }}</h3>
                    <hr />
                    <p>{{ 'Rp ' . number_format($product->price, 2, ',', '.') }}</p>
                    <code>
                        <p>{!! $product->description !!}</p>
                    </code>
                    <hr />
                    <p>Stock : {{ $product->stock }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
