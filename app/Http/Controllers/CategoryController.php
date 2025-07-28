<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Repositories\CategoryRepositoryInterface;

class CategoryController extends Controller
{
    /**
     * L'instance du repository de la catégorie.
     *
     * @var CategoryRepositoryInterface
     */
    protected $categoryRepository;

    /**
     * Crée une nouvelle instance du contrôleur.
     *
     * @param CategoryRepositoryInterface $categoryRepository
     * @return void
     */
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Affiche une liste des ressources.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $categories = $this->categoryRepository->getAll();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Affiche le formulaire de création d'une nouvelle ressource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Stocke une ressource nouvellement créée dans le stockage.
     *
     * @param StoreCategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCategoryRequest $request)
    {
        $this->categoryRepository->create($request->validated());
        return redirect()->route('categories.index')->with('success', 'Catégorie créée avec succès.');
    }

    /**
     * Affiche la ressource spécifiée.
     *
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show(int $id)
    {
        $category = $this->categoryRepository->findById($id);
        if (!$category) {
            return redirect()->route('categories.index')->with('error', 'Catégorie non trouvée.');
        }
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Affiche le formulaire d'édition de la ressource spécifiée.
     *
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit(int $id)
    {
        $category = $this->categoryRepository->findById($id);
        if (!$category) {
            return redirect()->route('categories.index')->with('error', 'Catégorie non trouvée.');
        }
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Met à jour la ressource spécifiée dans le stockage.
     *
     * @param UpdateCategoryRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateCategoryRequest $request, int $id)
    {
        $category = $this->categoryRepository->findById($id);
        if (!$category) {
            return redirect()->route('categories.index')->with('error', 'Catégorie non trouvée.');
        }
        $this->categoryRepository->update($category, $request->validated());
        return redirect()->route('categories.index')->with('success', 'Catégorie mise à jour avec succès.');
    }

    /**
     * Supprime la ressource spécifiée du stockage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        $category = $this->categoryRepository->findById($id);
        if (!$category) {
            return redirect()->route('categories.index')->with('error', 'Catégorie non trouvée.');
        }
        $this->categoryRepository->delete($category); // Soft delete
        return redirect()->route('categories.index')->with('success', 'Catégorie supprimée avec succès.');
    }
}