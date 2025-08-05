<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Resources\PaymentResource;
use App\Repositories\PaymentRepositoryInterface;
use Illuminate\Http\JsonResponse;

class PaymentApiController extends Controller
{
    /**
     * L'instance du repository du paiement.
     *
     * @var PaymentRepositoryInterface
     */
    protected $paymentRepository;

    /**
     * Crée une nouvelle instance du contrôleur.
     *
     * @param PaymentRepositoryInterface $paymentRepository
     * @return void
     */
    public function __construct(PaymentRepositoryInterface $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    /**
     * Affiche une liste des ressources.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $payments = $this->paymentRepository->getAll();
        return PaymentResource::collection($payments)->response();
    }

    /**
     * Stocke une ressource nouvellement créée dans le stockage.
     *
     * @param StorePaymentRequest $request
     * @return JsonResponse
     */
    public function store(StorePaymentRequest $request): JsonResponse
    {
        $payment = $this->paymentRepository->create($request->validated());
        return (new PaymentResource($payment))
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
        $payment = $this->paymentRepository->findById($id);
        if (!$payment) {
            return response()->json(['message' => 'Paiement non trouvé'], 404);
        }
        return (new PaymentResource($payment))->response();
    }

    /**
     * Met à jour la ressource spécifiée dans le stockage.
     *
     * @param UpdatePaymentRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdatePaymentRequest $request, int $id): JsonResponse
    {
        $payment = $this->paymentRepository->findById($id);
        if (!$payment) {
            return response()->json(['message' => 'Paiement non trouvé'], 404);
        }
        $updatedPayment = $this->paymentRepository->update($payment, $request->validated());
        return (new PaymentResource($updatedPayment))->response();
    }

    /**
     * Supprime la ressource spécifiée du stockage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $payment = $this->paymentRepository->findById($id);
        if (!$payment) {
            return response()->json(['message' => 'Paiement non trouvé'], 404);
        }
        $this->paymentRepository->delete($payment); // Soft delete
        return response()->json(null, 204); // 204 No Content
    }
}
