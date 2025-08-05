<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::all();
        return view('admin.companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request)
    {
        $data = $request->validated();

        // Vérifie si un logo a été uploadé
        if ($request->hasFile('logo')) {
            $data['logo'] = 'storage/'.$request->file('logo')->store('companies/logo', 'public'); // Stocke dans storage/app/public/companies/logo
        }

        Company::create($data);

        return redirect()->route('companies.index')->with('success', 'Company created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        return view('companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return view('admin.companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $data = $request->validated();

        // Vérifie si un logo a été uploadé
        if ($request->hasFile('logo')) {
            $relativePath = str_replace('storage/', '', $company->logo);
            if (Str::startsWith($relativePath, 'companies/logo/') && Storage::disk('public')->exists($relativePath)) {
                Storage::disk('public')->delete($relativePath);
            }

            $data['logo'] = 'storage/'.$request->file('logo')->store('companies/logo', 'public'); // Stocke dans storage/app/public/companies/logo
        }

        $company->update($data);
        return redirect()->route('companies.index')->with('success', 'Company updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        if ($company->logo && Storage::disk('public')->exists($company->logo)) {
            Storage::disk('public')->delete($company->logo);
        }
        
        $company->delete(); // Soft delete
        return redirect()->route('companies.index')->with('success', 'Company deleted successfully.');
    }
}