<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Repositories\ProductRepositoryInterface;
use Illuminate\Http\JsonResponse;

class ProductApiController extends Controller
{
    /**
     * L'instance du repository du produit.
     *
     * @var ProductRepositoryInterface
     */
    protected $productRepository;

    /**
     * Crée une nouvelle instance du contrôleur.
     *
     * @param ProductRepositoryInterface $productRepository
     * @return void
     */
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Affiche une liste des ressources.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $products = $this->productRepository->getAll();
        return ProductResource::collection($products)->response();
    }

    /**
     * Stocke une ressource nouvellement créée dans le stockage.
     *
     * @param StoreProductRequest $request
     * @return JsonResponse
     */
    public function store(StoreProductRequest $request): JsonResponse
    {
        $product = $this->productRepository->create($request->validated());
        return (new ProductResource($product))
                    ->response()
                    ->setStatusCode(201); // 201 Created
    }

    /**
     * Affiche la ressource spécifiée.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $product = $this->productRepository->findById($id);
        if (!$product) {
            return response()->json(['message' => 'Produit non trouvé'], 404);
        }
        return (new ProductResource($product))->response();
    }

    /**
     * Met à jour la ressource spécifiée dans le stockage.
     *
     * @param UpdateProductRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateProductRequest $request, int $id): JsonResponse
    {
        $product = $this->productRepository->findById($id);
        if (!$product) {
            return response()->json(['message' => 'Produit non trouvé'], 404);
        }
        $updatedProduct = $this->productRepository->update($product, $request->validated());
        return (new ProductResource($updatedProduct))->response();
    }

    /**
     * Supprime la ressource spécifiée du stockage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $product = $this->productRepository->findById($id);
        if (!$product) {
            return response()->json(['message' => 'Produit non trouvé'], 404);
        }
        $this->productRepository->delete($product); // Soft delete
        return response()->json(null, 204); // 204 No Content
    }
}