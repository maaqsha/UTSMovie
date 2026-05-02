@extends('layout.template')  
@section('title', 'Input Data Movie')  
@section('content')
    <h2 class="mb-4">Tambah Movie Baru</h2>
    <form action="/movies/store" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="id" class="form-label">ID Film:</label>
            <input type="text" class="form-control" id="id" name="id" required>
        </div>
        @include('partials.movie-form', [
            'action' => '/movies/store',
            'buttonText' => 'Simpan',
            'categories' => $categories
        ])
    </form>
@endsection

