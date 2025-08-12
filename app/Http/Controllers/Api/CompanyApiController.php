<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Company;
use Illuminate\Http\JsonResponse;
use App\Resources\CompanyResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Repositories\CompanyRepositoryInterface;

class CompanyApiController extends Controller
{
    /**
     * L'instance du repository de la commande.
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
    public function index(): JsonResponse
    {
        $companies = $this->companyRepository->getAll();
        return CompanyResource::collection($companies)->response();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request): JsonResponse
    {
        $data = $request->validated();

        // Gérer l'upload du logo de la compagnie
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('companies/logo', 'public');
            $data['logo'] = 'storage/' . $logoPath;
        } else {
            $data['logo'] = null;
        }

        // Extraire données compagnie
        $companyData = [
            'company_name' => $data['company_name'],
            'register_id' => $data['register_id'],
            'address' => $data['address'],
            'contact' => $data['contact'],
            'logo' => $data['logo'],
        ];

        // Créer la compagnie
        $company = $this->companyRepository->create($companyData);

        // Gérer l'upload de la photo utilisateur
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('users/photos', 'public');
            $data['photo'] = 'storage/' . $photoPath;
        } else {
            $data['photo'] = null;
        }

        // Préparer les données utilisateur
        $userData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
            'photo' => $data['photo'],
            'company_id' => $company->id,
        ];

        // Création user
        $user = User::create($userData);

        // Générer un token sanctum
        $token = $user->createToken('api-token')->plainTextToken;

        // Retourner user + token
        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        $company = $this->companyRepository->findById($id);
        if (!$company) {
            return response()->json(['message' => 'Commande non trouvée'], 404);
        }
        return (new CompanyResource($company))->response();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, int $id): JsonResponse
    {
        $company = $this->companyRepository->findById($id);
        if (!$company) {
            return response()->json(['message' => 'Commande non trouvée'], 404);
        }
        $updatedcompany = $this->companyRepository->update($company, $request->validated());
        return (new CompanyResource($updatedcompany))->response();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        $company = $this->companyRepository->findById($id);
        if (!$company) {
            return response()->json(['message' => 'Commande non trouvée'], 404);
        }
        $this->companyRepository->delete($company); // Soft delete
        return response()->json(null, 204); // 204 No Content
    }
}
