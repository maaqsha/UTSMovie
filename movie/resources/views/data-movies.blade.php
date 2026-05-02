@extends('layout.template')

@section('title', 'Data Movie')

@section('content')

@include('partials.alert')

<h1>Data-Movie</h1>
<div class="mb-3">
    <a href="/movies/create" class="btn btn-primary">Tambah Movie</a>
</div>

@include('partials.movies-table', ['movies' => $movies])

<div class="d-flex justify-content-center">
    {{ $movies->links() }}
</div>

@endsection

