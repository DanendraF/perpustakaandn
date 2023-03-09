@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3>Buku {{ $buku->judul }}</h3>
                </div>
                <div class="card-body">
                    <img src="{{Storage::url($buku->image)}}" alt="{{ $buku->judul }}" class="img-thumbnail"
                        style="max-width: 300px;">
                    <h3 class="mt-3">Judul : {{ $buku->judul }}</h3>
                    <p class="mt-3">Pengarang : {{ $buku->pengarang }}</p>
                    <p class="mt-3">Penerbit : {{ $buku->penerbit}}</p>
                    </br>
                    <a href="{{ route('buku.public.index') }}" class="btn btn-secondary">Kembali</a>

                </div>

            </div>
        </div>

    </div>
</div>
@endsection