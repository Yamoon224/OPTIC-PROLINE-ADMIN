<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Http\Requests\StoreNotificationRequest;
use App\Http\Requests\UpdateNotificationRequest;
use App\Resources\NotificationResource;
use Illuminate\Http\JsonResponse;

class NotificationApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $notifications = Notification::all();
        return NotificationResource::collection($notifications)->response();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNotificationRequest $request): JsonResponse
    {
        $notification = Notification::create($request->validated());
        return (new NotificationResource($notification))
                    ->response()
                    ->setStatusCode(201); // 201 Created
    }

    /**
     * Display the specified resource.
     */
    public function show(Notification $notification): JsonResponse
    {
        return (new NotificationResource($notification))->response();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNotificationRequest $request, Notification $notification): JsonResponse
    {
        $notification->update($request->validated());
        return (new NotificationResource($notification))->response();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notification $notification): JsonResponse
    {
        $notification->delete(); // Soft delete
        return response()->json(null, 204); // 204 No Content
    }
}