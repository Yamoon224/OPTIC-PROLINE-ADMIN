<?php

namespace App\Repositories\Eloquent;

use App\Models\Notification;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\NotificationRepositoryInterface;

/**
 * Eloquent implementation of Notification Repository.
 */
class NotificationRepository implements NotificationRepositoryInterface
{
    /**
     * Get all notifications.
     */
    public function getAll(): Collection
    {
        return Notification::all();
    }

    /**
     * Find a notification by its ID.
     */
    public function findById(int $id): ?Notification
    {
        return Notification::find($id);
    }

    /**
     * Create a new notification.
     */
    public function create(array $data): Notification
    {
        return Notification::create($data);
    }

    /**
     * Update an existing notification.
     */
    public function update(Notification $notification, array $data): Notification
    {
        $notification->update($data);
        return $notification;
    }

    /**
     * Delete a notification.
     */
    public function delete(Notification $notification): bool
    {
        return $notification->delete();
    }
}