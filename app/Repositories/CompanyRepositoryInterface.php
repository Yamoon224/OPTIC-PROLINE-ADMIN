<?php

namespace App\Repositories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface for Company Repository.
 */
interface CompanyRepositoryInterface
{
    public function getAll(): Collection;
    public function findById(int $id): ?Company;
    public function create(array $data): Company;
    public function update(Company $company, array $data): Company;
    public function delete(Company $company): bool;
}