<?php

namespace App\Repositories;

use App\Models\Notification;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface for Notification Repository.
 */
interface NotificationRepositoryInterface
{
    public function getAll(): Collection;
    public function findById(int $id): ?Notification;
    public function create(array $data): Notification;
    public function update(Notification $notification, array $data): Notification;
    public function delete(Notification $notification): bool;
}