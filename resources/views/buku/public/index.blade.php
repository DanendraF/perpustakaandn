@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1>Daftar Buku</h1>
            <hr>

            <!-- Display search form -->
            <form action="{{ route('buku.public.index') }}" method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari judul, pengarang, atau penerbit..."
                        name="search">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Cari</button>
                    </div>
                </div>
            </form>

            <!-- Display list of books -->
            <div class="row">
                @foreach ($buku as $b)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        @if ($b->image)
                        <img src="{{Storage::url($b->image)}}" alt="{{ $b->judul }}" class="card-img-top">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">Judul : {{ $b->judul }}</h5>
                            <p class="card-text">Pengarang : {{ $b->pengarang }}</p>
                            <a href="{{ route('buku.public.show', $b->id) }}" class="btn btn-info">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Display pagination links -->
            <div class="mt-3">
                {{ $buku->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection