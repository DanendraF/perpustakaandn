@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <b>Detail Buku</b>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">

                            <img src="{{Storage::url($buku->image)}}" alt="{{ $buku->judul }}"
                                style="max-width: 230px;">

                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="judul">
                                    <b>Judul</b>
                                </label>
                                <input type="text" class="form-control" id="judul" value="{{ $buku->judul }}" readonly>
                            </div>

                            <div class="form-group mt-3">
                                <label for="pengarang">
                                    <b>Pengarang</b>
                                </label>
                                <input type="text" class="form-control" id="pengarang" value="{{ $buku->pengarang }}"
                                    readonly>
                            </div>

                            <div class="form-group mt-3">
                                <label for="penerbit">
                                    <b>Penerbit</b>
                                </label>
                                <input type="text" class="form-control" id="penerbit" value="{{ $buku->penerbit }}"
                                    readonly>
                            </div>
                            </br>
                            <div class="form-group">
                                <a href="{{ route('buku.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection