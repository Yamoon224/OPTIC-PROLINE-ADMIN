<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Resources\CompanyResource;
use Illuminate\Http\JsonResponse;

class CompanyApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $companies = Company::all();
        return CompanyResource::collection($companies)->response();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request): JsonResponse
    {
        $company = Company::create($request->validated());
        return (new CompanyResource($company))
                    ->response()
                    ->setStatusCode(201); // 201 Created
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company): JsonResponse
    {
        return (new CompanyResource($company))->response();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, Company $company): JsonResponse
    {
        $company->update($request->validated());
        return (new CompanyResource($company))->response();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company): JsonResponse
    {
        $company->delete(); // Soft delete
        return response()->json(null, 204); // 204 No Content
    }
}
