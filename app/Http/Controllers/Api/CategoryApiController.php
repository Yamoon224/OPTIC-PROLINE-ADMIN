<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Repositories\CategoryRepositoryInterface;
use Illuminate\Http\JsonResponse;

class CategoryApiController extends Controller
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
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $categories = $this->categoryRepository->getAll();
        return CategoryResource::collection($categories)->response();
    }

    /**
     * Stocke une ressource nouvellement créée dans le stockage.
     *
     * @param StoreCategoryRequest $request
     * @return JsonResponse
     */
    public function store(StoreCategoryRequest $request): JsonResponse
    {
        $category = $this->categoryRepository->create($request->validated());
        return (new CategoryResource($category))
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
        $category = $this->categoryRepository->findById($id);
        if (!$category) {
            return response()->json(['message' => 'Catégorie non trouvée'], 404);
        }
        return (new CategoryResource($category))->response();
    }

    /**
     * Met à jour la ressource spécifiée dans le stockage.
     *
     * @param UpdateCategoryRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateCategoryRequest $request, int $id): JsonResponse
    {
        $category = $this->categoryRepository->findById($id);
        if (!$category) {
            return response()->json(['message' => 'Catégorie non trouvée'], 404);
        }
        $updatedCategory = $this->categoryRepository->update($category, $request->validated());
        return (new CategoryResource($updatedCategory))->response();
    }

    /**
     * Supprime la ressource spécifiée du stockage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $category = $this->categoryRepository->findById($id);
        if (!$category) {
            return response()->json(['message' => 'Catégorie non trouvée'], 404);
        }
        $this->categoryRepository->delete($category); // Soft delete
        return response()->json(null, 204); // 204 No Content
    }
}