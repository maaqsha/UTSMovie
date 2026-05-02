<?php

namespace App\Interfaces;

use App\Models\Movie;

interface MovieRepositoryInterface
{
    public function getAll(?string $search = null, int $perPage = 6);
    public function getById(int $id): ?Movie;
    public function create(array $data): Movie;
    public function update(int $id, array $data): Movie;
    public function delete(int $id): bool;
}
