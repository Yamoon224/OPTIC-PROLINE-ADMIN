<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNotificationRequest;
use App\Http\Requests\UpdateNotificationRequest;
use App\Repositories\NotificationRepositoryInterface;
use Illuminate\Http\JsonResponse;

class NotificationController extends Controller
{
    /**
     * The notification repository instance.
     *
     * @var NotificationRepositoryInterface
     */
    protected $notificationRepository;

    /**
     * Create a new controller instance.
     *
     * @param NotificationRepositoryInterface $notificationRepository
     * @return void
     */
    public function __construct(NotificationRepositoryInterface $notificationRepository)
    {
        $this->notificationRepository = $notificationRepository;
    }

    /**
     * Display a listing of the notifications.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        // Récupérer toutes les notifications via le repository
        $notifications = $this->notificationRepository->getAll();
        return response()->json($notifications);
    }

    /**
     * Store a newly created notification in storage.
     *
     * @param StoreNotificationRequest $request
     * @return JsonResponse
     */
    public function store(StoreNotificationRequest $request): JsonResponse
    {
        // Créer une nouvelle notification via le repository
        $notification = $this->notificationRepository->create($request->validated());
        return response()->json($notification, 201); // 201 Created
    }

    /**
     * Display the specified notification.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        // Trouver une notification par son ID via le repository
        $notification = $this->notificationRepository->findById($id);

        if (!$notification) {
            return response()->json(['message' => 'Notification not found'], 404);
        }

        return response()->json($notification);
    }

    /**
     * Update the specified notification in storage.
     *
     * @param UpdateNotificationRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateNotificationRequest $request, int $id): JsonResponse
    {
        // Trouver la notification à mettre à jour
        $notification = $this->notificationRepository->findById($id);

        if (!$notification) {
            return response()->json(['message' => 'Notification not found'], 404);
        }

        // Mettre à jour la notification via le repository
        $updatedNotification = $this->notificationRepository->update($notification, $request->validated());
        return response()->json($updatedNotification);
    }

    /**
     * Remove the specified notification from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        // Trouver la notification à supprimer
        $notification = $this->notificationRepository->findById($id);

        if (!$notification) {
            return response()->json(['message' => 'Notification not found'], 404);
        }

        // Supprimer la notification via le repository
        $this->notificationRepository->delete($notification);
        return response()->json(null, 204); // 204 No Content
    }
}
