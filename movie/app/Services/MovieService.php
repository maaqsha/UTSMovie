<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Interfaces\MovieRepositoryInterface;

class MovieService
{
    protected $movieRepository;

    public function __construct(MovieRepositoryInterface $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    public function getAllMovies(?string $search = null, int $perPage = 6)
    {
        return $this->movieRepository->getAll($search, $perPage);
    }

    public function getMovieById(int $id)
    {
        return $this->movieRepository->getById($id);
    }

    public function getAllCategories()
    {
        return Category::all();
    }

    public function getPaginatedMovies(int $perPage = 10)
    {
        return $this->movieRepository->getAll(null, $perPage);
    }

    public function createMovie(array $data)
    {
        return $this->movieRepository->create($data);
    }

    public function updateMovie(int $id, array $data)
    {
        return $this->movieRepository->update($id, $data);
    }

    public function deleteMovie(int $id): bool
    {
        $movie = $this->movieRepository->getById($id);
        if ($movie) {
            $this->deleteMoviePhoto($movie->foto_sampul);
        }
        return $this->movieRepository->delete($id);
    }

    public function storeMoviePhoto($file): string
    {
        $randomName = Str::uuid()->toString();
        $fileExtension = $file->getClientOriginalExtension();
        $fileName = $randomName . '.' . $fileExtension;
        
        $file->move(public_path('images'), $fileName);
        
        return $fileName;
    }

    public function updateMoviePhoto($movie, $newPhotoFile): string
    {
        $randomName = Str::uuid()->toString();
        $fileExtension = $newPhotoFile->getClientOriginalExtension();
        $fileName = $randomName . '.' . $fileExtension;

        $newPhotoFile->move(public_path('images'), $fileName);
        $this->deleteMoviePhoto($movie->foto_sampul);

        return $fileName;
    }

    public function deleteMoviePhoto(string $photoName): void
    {
        if ($photoName && File::exists(public_path('images/' . $photoName))) {
            File::delete(public_path('images/' . $photoName));
        }
    }
}
