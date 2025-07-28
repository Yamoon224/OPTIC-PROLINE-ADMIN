<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;

class UserApiController extends Controller
{
    /**
     * L'instance du repository de l'utilisateur.
     *
     * @var UserRepositoryInterface
     */
    protected $userRepository;

    /**
     * Crée une nouvelle instance du contrôleur.
     *
     * @param UserRepositoryInterface $userRepository
     * @return void
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Affiche une liste des ressources.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $users = $this->userRepository->getAll();
        return UserResource::collection($users)->response();
    }

    /**
     * Stocke une ressource nouvellement créée dans le stockage.
     *
     * @param StoreUserRequest $request
     * @return JsonResponse
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        $user = $this->userRepository->create($request->validated());
        return (new UserResource($user))
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
        $user = $this->userRepository->findById($id);
        if (!$user) {
            return response()->json(['message' => 'Utilisateur non trouvé'], 404);
        }
        return (new UserResource($user))->response();
    }

    /**
     * Met à jour la ressource spécifiée dans le stockage.
     *
     * @param UpdateUserRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateUserRequest $request, int $id): JsonResponse
    {
        $user = $this->userRepository->findById($id);
        if (!$user) {
            return response()->json(['message' => 'Utilisateur non trouvé'], 404);
        }
        $userData = $request->validated();
        if (isset($userData['password']) && empty($userData['password'])) {
            unset($userData['password']);
        }
        $updatedUser = $this->userRepository->update($user, $userData);
        return (new UserResource($updatedUser))->response();
    }

    /**
     * Supprime la ressource spécifiée du stockage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $user = $this->userRepository->findById($id);
        if (!$user) {
            return response()->json(['message' => 'Utilisateur non trouvé'], 404);
        }
        $this->userRepository->delete($user); // Soft delete
        return response()->json(null, 204); // 204 No Content
    }
}
