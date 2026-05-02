<?php

namespace App\Repositories;

use App\Models\Movie;
use App\Interfaces\MovieRepositoryInterface;

class MovieRepository implements MovieRepositoryInterface
{
    public function getAll(?string $search = null, int $perPage = 6)
    {
        $query = Movie::latest();

        if ($search) {
            $query->where('judul', 'like', '%' . $search . '%')
                ->orWhere('sinopsis', 'like', '%' . $search . '%');
        }

        return $query->paginate($perPage)->withQueryString();
    }

    public function getById(int $id): ?Movie
    {
        return Movie::find($id);
    }

    public function create(array $data): Movie
    {
        return Movie::create($data);
    }

    public function update(int $id, array $data): Movie
    {
        $movie = Movie::findOrFail($id);
        $movie->update($data);
        return $movie;
    }

    public function delete(int $id): bool
    {
        return Movie::findOrFail($id)->delete();
    }
}
