<?php

use App\Models\Buku;

$bukus = Buku::orderBy('id', 'desc')->paginate(10);

?>

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('List Buku') }}</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Judul</th>
                                    <th>Penerbit</th>
                                    <th>Pengarang</th>
                                    <th>Cover</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bukus as $key => $buku)
                                    <tr>
                                        <td>{{ $bukus->firstItem() + $key }}</td>
                                        <td>{{ $buku->judul }}</td>
                                        <td>{{ $buku->penerbit }}</td>
                                        <td>{{ $buku->pengarang }}</td>
                                        <td><img src="{{ asset('storage/'.$buku->image) }}" alt="{{ $buku->judul }}" style="max-width: 150px;"></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $bukus->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
