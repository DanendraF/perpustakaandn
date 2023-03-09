@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Buku</h1>
    <hr>

    <!-- Display success message if there is any -->
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="row">
        <div class="col-md-6 mb-3">
            <form action="{{ route('buku.index') }}" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search..." name="search">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Search</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-md-6 text-right">
            <a href="{{ route('buku.create') }}" class="btn btn-primary float-right">Add Book</a>
        </div>

    </div>


    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Pengarang</th>
                <th>Penerbit</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bukus as $key => $buku)
            <tr>
                <td>{{ ($bukus->currentPage()-1) * $bukus->perPage() + $loop->iteration }}</td>
                <td>{{ $buku->judul }}</td>
                <td>{{ $buku->pengarang }}</td>
                <td>{{ $buku->penerbit }}</td>
                <td>
                    @if ($buku->image)
                    <img src="{{Storage::url($buku->image)}}" alt="{{ $buku->judul }}" style="max-width: 100px;">
                    @else
                    No Image
                    @endif
                </td>
                <td>
                    <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <a href="{{ route('buku.show', $buku->id) }}" class="btn btn-info btn-sm">Show</a>

                    <form action="{{ route('buku.destroy', $buku->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Display pagination links -->
    <div class="text-center">
        {{ $bukus->links() }}
    </div>

</div>
@endsection