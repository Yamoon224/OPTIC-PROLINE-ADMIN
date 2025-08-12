<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Repositories\CompanyRepositoryInterface;

class CompanyController extends Controller
{
    /**
     * L'instance du repository de la catégorie.
     *
     * @var CompanyRepositoryInterface
     */
    protected $companyRepository;

    /**
     * Crée une nouvelle instance du contrôleur.
     *
     * @param CompanyRepositoryInterface $companyRepository
     * @return void
     */
    public function __construct(CompanyRepositoryInterface $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = $this->companyRepository->getAll();
        return view('admin.companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.companies.add');
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

        $this->companyRepository->create($data);

        return redirect()->route('companies.index')->with('success', 'Company created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $company = $this->companyRepository->findById($id);
        return view('admin.companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $company = $this->companyRepository->findById($id);
        if (!$company) {
            return redirect()->route('companies.index')->with('error', 'Produit non trouvé.');
        }
        return view('admin.companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, int $id)
    {
        $data = $request->validated();

        $company = $this->companyRepository->findById($id);

        // Vérifie si un logo a été uploadé
        if ($request->hasFile('logo')) {
            dump($company);
            $relativePath = str_replace('storage/', '', $company->logo);
            if (Str::startsWith($relativePath, 'companies/logo/') && Storage::disk('public')->exists($relativePath)) {
                Storage::disk('public')->delete($relativePath);
            }

            $data['logo'] = 'storage/'.$request->file('logo')->store('companies/logo', 'public'); // Stocke dans storage/app/public/companies/logo
        }

        $this->companyRepository->update($company, $data);
        return redirect()->route('companies.index')->with('success', 'Company updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $company = $this->companyRepository->findById($id);

        if ($company->logo && Storage::disk('public')->exists($company->logo)) {
            Storage::disk('public')->delete($company->logo);
        }
        
        $this->companyRepository->delete($company); // Soft delete
        return redirect()->route('companies.index')->with('success', 'Company deleted successfully.');
    }
}