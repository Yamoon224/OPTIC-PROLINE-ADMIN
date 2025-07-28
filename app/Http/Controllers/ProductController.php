<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\CategoryRepositoryInterface; // Pour récupérer les catégories

class ProductController extends Controller
{
    /**
     * L'instance du repository du produit.
     *
     * @var ProductRepositoryInterface
     */
    protected $productRepository;

    /**
     * L'instance du repository de la catégorie.
     *
     * @var CategoryRepositoryInterface
     */
    protected $categoryRepository;

    /**
     * Crée une nouvelle instance du contrôleur.
     *
     * @param ProductRepositoryInterface $productRepository
     * @param CategoryRepositoryInterface $categoryRepository
     * @return void
     */
    public function __construct(ProductRepositoryInterface $productRepository, CategoryRepositoryInterface $categoryRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Affiche une liste des ressources.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $products = $this->productRepository->getAll();
        $categories = $this->categoryRepository->getAll();
        return view('admin.products.index', compact('products', 'categories'));
    }

    /**
     * Affiche le formulaire de création d'une nouvelle ressource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = $this->categoryRepository->getAll();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Stocke une ressource nouvellement créée dans le stockage.
     *
     * @param StoreProductRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreProductRequest $request)
    {
        $this->productRepository->create($request->validated());
        return redirect()->route('products.index')->with('success', 'Produit créé avec succès.');
    }

    /**
     * Affiche la ressource spécifiée.
     *
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show(int $id)
    {
        $product = $this->productRepository->findById($id);
        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Produit non trouvé.');
        }
        return view('admin.products.show', compact('product'));
    }

    /**
     * Affiche le formulaire d'édition de la ressource spécifiée.
     *
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit(int $id)
    {
        $product = $this->productRepository->findById($id);
        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Produit non trouvé.');
        }
        $categories = $this->categoryRepository->getAll();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Met à jour la ressource spécifiée dans le stockage.
     *
     * @param UpdateProductRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateProductRequest $request, int $id)
    {
        $product = $this->productRepository->findById($id);
        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Produit non trouvé.');
        }
        $this->productRepository->update($product, $request->validated());
        return redirect()->route('products.index')->with('success', 'Produit mis à jour avec succès.');
    }

    /**
     * Supprime la ressource spécifiée du stockage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        $product = $this->productRepository->findById($id);
        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Produit non trouvé.');
        }
        $this->productRepository->delete($product); // Soft delete
        return redirect()->route('products.index')->with('success', 'Produit supprimé avec succès.');
    }
}