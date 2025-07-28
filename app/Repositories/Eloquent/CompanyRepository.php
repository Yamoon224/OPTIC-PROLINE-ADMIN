<?php

namespace App\Repositories\Eloquent;

use App\Repositories\CompanyRepositoryInterface;
use App\Models\Company;
use Illuminate\Database\Eloquent\Collection;

/**
 * Eloquent implementation of Company Repository.
 */
class CompanyRepository implements CompanyRepositoryInterface
{
    /**
     * Get all companies.
     */
    public function getAll(): Collection
    {
        return Company::orderByDesc('id')->get();
    }

    /**
     * Find a company by its ID.
     */
    public function findById(int $id): ?Company
    {
        return Company::find($id);
    }

    /**
     * Create a new company.
     */
    public function create(array $data): Company
    {
        return Company::create($data);
    }

    /**
     * Update an existing company.
     */
    public function update(Company $company, array $data): Company
    {
        $company->update($data);
        return $company;
    }

    /**
     * Delete a company.
     */
    public function delete(Company $company): bool
    {
        return $company->delete();
    }
}