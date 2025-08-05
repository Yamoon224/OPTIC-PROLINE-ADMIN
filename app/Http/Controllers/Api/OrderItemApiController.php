<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderItemRequest;
use App\Http\Requests\UpdateOrderItemRequest;
use App\Resources\OrderItemResource;
use App\Repositories\OrderItemRepositoryInterface;
use Illuminate\Http\JsonResponse;

class OrderItemApiController extends Controller
{
    /**
     * L'instance du repository de l'élément de commande.
     *
     * @var OrderItemRepositoryInterface
     */
    protected $orderItemRepository;

    /**
     * Crée une nouvelle instance du contrôleur.
     *
     * @param OrderItemRepositoryInterface $orderItemRepository
     * @return void
     */
    public function __construct(OrderItemRepositoryInterface $orderItemRepository)
    {
        $this->orderItemRepository = $orderItemRepository;
    }

    /**
     * Affiche une liste des ressources.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $orderItems = $this->orderItemRepository->getAll();
        return OrderItemResource::collection($orderItems)->response();
    }

    /**
     * Stocke une ressource nouvellement créée dans le stockage.
     *
     * @param StoreOrderItemRequest $request
     * @return JsonResponse
     */
    public function store(StoreOrderItemRequest $request): JsonResponse
    {
        $orderItem = $this->orderItemRepository->create($request->validated());
        return (new OrderItemResource($orderItem))
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
        $orderItem = $this->orderItemRepository->findById($id);
        if (!$orderItem) {
            return response()->json(['message' => 'Élément de commande non trouvé'], 404);
        }
        return (new OrderItemResource($orderItem))->response();
    }

    /**
     * Met à jour la ressource spécifiée dans le stockage.
     *
     * @param UpdateOrderItemRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateOrderItemRequest $request, int $id): JsonResponse
    {
        $orderItem = $this->orderItemRepository->findById($id);
        if (!$orderItem) {
            return response()->json(['message' => 'Élément de commande non trouvé'], 404);
        }
        $updatedOrderItem = $this->orderItemRepository->update($orderItem, $request->validated());
        return (new OrderItemResource($updatedOrderItem))->response();
    }

    /**
     * Supprime la ressource spécifiée du stockage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $orderItem = $this->orderItemRepository->findById($id);
        if (!$orderItem) {
            return response()->json(['message' => 'Élément de commande non trouvé'], 404);
        }
        $this->orderItemRepository->delete($orderItem); // Soft delete
        return response()->json(null, 204); // 204 No Content
    }
}