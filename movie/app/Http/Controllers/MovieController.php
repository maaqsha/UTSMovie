<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MovieService;
use App\Http\Requests\StoreMovieRequest;

class MovieController extends Controller
{
    protected $movieService;

    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    public function index()
    {
        $searchQuery = request('search');
        $movies = $this->movieService->getAllMovies($searchQuery, 6);
        return view('homepage', compact('movies'));
    }

    public function detail(int $movieId)
    {
        $movie = $this->movieService->getMovieById($movieId);
        return view('detail', compact('movie'));
    }

    public function create()
    {
        $categories = $this->getCategories();
        return view('input', compact('categories'));
    }

    public function store(StoreMovieRequest $request)
    {
        $validatedData = $request->validated();
        $this->handlePhotoUpload($request, $validatedData);
        $this->movieService->createMovie($validatedData);

        return redirect('/')->with('success', 'Film berhasil ditambahkan.');
    }

    public function data()
    {
        $movies = $this->movieService->getPaginatedMovies(10);
        return view('data-movies', compact('movies'));
    }

    public function edit(int $movieId)
    {
        $movie = $this->movieService->getMovieById($movieId);
        $categories = $this->getCategories();
        return view('form-edit', compact('movie', 'categories'));
    }

    public function update(Request $request, int $movieId)
    {
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'sinopsis' => 'required|string',
            'tahun' => 'required|integer',
            'pemain' => 'required|string',
            'foto_sampul' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $movie = $this->movieService->getMovieById($movieId);
        
        if ($request->hasFile('foto_sampul')) {
            $validatedData['foto_sampul'] = $this->movieService->updateMoviePhoto(
                $movie,
                $request->file('foto_sampul')
            );
        }

        $this->movieService->updateMovie($movieId, $validatedData);

        return redirect('/movies/data')->with('success', 'Data berhasil diperbarui');
    }

    public function delete(int $movieId)
    {
        $this->movieService->deleteMovie($movieId);
        return redirect('/movies/data')->with('success', 'Data berhasil dihapus');
    }

    private function getCategories()
    {
        return $this->movieService->getAllCategories();
    }

    private function handlePhotoUpload(Request $request, array &$validatedData): void
    {
        if ($request->hasFile('foto_sampul')) {
            $validatedData['foto_sampul'] = $this->movieService->storeMoviePhoto(
                $request->file('foto_sampul')
            );
        }
    }
}

