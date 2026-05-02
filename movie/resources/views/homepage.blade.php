@extends('layout.template')

@section('title', 'Homepage')

@section('content')

@include('partials.alert')

<h1>Popular Movie</h1>
<div class="row">
    @foreach ($movies as $movie)
    <div class="col-lg-6">
        @include('partials.movie-card', ['movie' => $movie])
    </div>
    @endforeach
    <div class="d-flex justify-content-center">
        {{ $movies->links() }}
    </div>
</div>
@endsection
