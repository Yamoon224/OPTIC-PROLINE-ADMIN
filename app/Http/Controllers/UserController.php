<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\CompanyRepositoryInterface; // Pour récupérer les entreprises

class UserController extends Controller
{
    /**
     * L'instance du repository de l'utilisateur.
     *
     * @var UserRepositoryInterface
     */
    protected $userRepository;

    /**
     * L'instance du repository de l'entreprise.
     *
     * @var CompanyRepositoryInterface
     */
    protected $companyRepository;

    /**
     * Crée une nouvelle instance du contrôleur.
     *
     * @param UserRepositoryInterface $userRepository
     * @param CompanyRepositoryInterface $companyRepository
     * @return void
     */
    public function __construct(UserRepositoryInterface $userRepository, CompanyRepositoryInterface $companyRepository)
    {
        $this->userRepository = $userRepository;
        $this->companyRepository = $companyRepository;
    }

    /**
     * Affiche une liste des ressources.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = $this->userRepository->getAll(); // Récupère tous les utilisateurs
        return view('users.index', compact('users'));
    }

    /**
     * Affiche le formulaire de création d'une nouvelle ressource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $companies = $this->companyRepository->getAll(); // Récupère toutes les entreprises
        return view('users.create', compact('companies'));
    }

    /**
     * Stocke une ressource nouvellement créée dans le stockage.
     *
     * @param StoreUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreUserRequest $request)
    {
        $userData = $request->validated();
        $this->userRepository->create($userData);
        return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès.');
    }

    /**
     * Affiche la ressource spécifiée.
     *
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show(int $id)
    {
        $user = $this->userRepository->findById($id);
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'Utilisateur non trouvé.');
        }
        return view('users.show', compact('user'));
    }

    /**
     * Affiche le formulaire d'édition de la ressource spécifiée.
     *
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit(int $id)
    {
        $user = $this->userRepository->findById($id);
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'Utilisateur non trouvé.');
        }
        $companies = $this->companyRepository->getAll();
        return view('users.edit', compact('user', 'companies'));
    }

    /**
     * Met à jour la ressource spécifiée dans le stockage.
     *
     * @param UpdateUserRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateUserRequest $request, int $id)
    {
        $user = $this->userRepository->findById($id);
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'Utilisateur non trouvé.');
        }
        $userData = $request->validated();
        if (isset($userData['password']) && empty($userData['password'])) {
            unset($userData['password']); // Ne pas mettre à jour le mot de passe s'il est vide
        }
        $this->userRepository->update($user, $userData);
        return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    /**
     * Supprime la ressource spécifiée du stockage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        $user = $this->userRepository->findById($id);
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'Utilisateur non trouvé.');
        }
        $this->userRepository->delete($user); // Soft delete
        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}