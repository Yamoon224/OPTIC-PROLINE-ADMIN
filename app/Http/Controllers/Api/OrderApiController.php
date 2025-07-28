<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Repositories\OrderRepositoryInterface;
use Illuminate\Http\JsonResponse;

class OrderApiController extends Controller
{
    /**
     * L'instance du repository de la commande.
     *
     * @var OrderRepositoryInterface
     */
    protected $orderRepository;

    /**
     * Crée une nouvelle instance du contrôleur.
     *
     * @param OrderRepositoryInterface $orderRepository
     * @return void
     */
    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * Affiche une liste des ressources.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $orders = $this->orderRepository->getAll();
        return OrderResource::collection($orders)->response();
    }

    /**
     * Stocke une ressource nouvellement créée dans le stockage.
     *
     * @param StoreOrderRequest $request
     * @return JsonResponse
     */
    public function store(StoreOrderRequest $request): JsonResponse
    {
        $order = $this->orderRepository->create($request->validated());
        return (new OrderResource($order))
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
        $order = $this->orderRepository->findById($id);
        if (!$order) {
            return response()->json(['message' => 'Commande non trouvée'], 404);
        }
        return (new OrderResource($order))->response();
    }

    /**
     * Met à jour la ressource spécifiée dans le stockage.
     *
     * @param UpdateOrderRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateOrderRequest $request, int $id): JsonResponse
    {
        $order = $this->orderRepository->findById($id);
        if (!$order) {
            return response()->json(['message' => 'Commande non trouvée'], 404);
        }
        $updatedOrder = $this->orderRepository->update($order, $request->validated());
        return (new OrderResource($updatedOrder))->response();
    }

    /**
     * Supprime la ressource spécifiée du stockage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $order = $this->orderRepository->findById($id);
        if (!$order) {
            return response()->json(['message' => 'Commande non trouvée'], 404);
        }
        $this->orderRepository->delete($order); // Soft delete
        return response()->json(null, 204); // 204 No Content
    }
}