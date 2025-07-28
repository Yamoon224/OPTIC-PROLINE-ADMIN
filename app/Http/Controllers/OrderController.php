<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Repositories\OrderRepositoryInterface;
use App\Repositories\UserRepositoryInterface; // Pour récupérer les utilisateurs

class OrderController extends Controller
{
    /**
     * L'instance du repository de la commande.
     *
     * @var OrderRepositoryInterface
     */
    protected $orderRepository;

    /**
     * L'instance du repository de l'utilisateur.
     *
     * @var UserRepositoryInterface
     */
    protected $userRepository;

    /**
     * Crée une nouvelle instance du contrôleur.
     *
     * @param OrderRepositoryInterface $orderRepository
     * @param UserRepositoryInterface $userRepository
     * @return void
     */
    public function __construct(OrderRepositoryInterface $orderRepository, UserRepositoryInterface $userRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Affiche une liste des ressources.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $orders = $this->orderRepository->getAll();
        return view('orders.index', compact('orders'));
    }

    /**
     * Affiche le formulaire de création d'une nouvelle ressource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $users = $this->userRepository->getAll();
        return view('orders.create', compact('users'));
    }

    /**
     * Stocke une ressource nouvellement créée dans le stockage.
     *
     * @param StoreOrderRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreOrderRequest $request)
    {
        $this->orderRepository->create($request->validated());
        return redirect()->route('orders.index')->with('success', 'Commande créée avec succès.');
    }

    /**
     * Affiche la ressource spécifiée.
     *
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show(int $id)
    {
        $order = $this->orderRepository->findById($id);
        if (!$order) {
            return redirect()->route('orders.index')->with('error', 'Commande non trouvée.');
        }
        return view('orders.show', compact('order'));
    }

    /**
     * Affiche le formulaire d'édition de la ressource spécifiée.
     *
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit(int $id)
    {
        $order = $this->orderRepository->findById($id);
        if (!$order) {
            return redirect()->route('orders.index')->with('error', 'Commande non trouvée.');
        }
        $users = $this->userRepository->getAll();
        return view('orders.edit', compact('order', 'users'));
    }

    /**
     * Met à jour la ressource spécifiée dans le stockage.
     *
     * @param UpdateOrderRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateOrderRequest $request, int $id)
    {
        $order = $this->orderRepository->findById($id);
        if (!$order) {
            return redirect()->route('orders.index')->with('error', 'Commande non trouvée.');
        }
        $this->orderRepository->update($order, $request->validated());
        return redirect()->route('orders.index')->with('success', 'Commande mise à jour avec succès.');
    }

    /**
     * Supprime la ressource spécifiée du stockage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        $order = $this->orderRepository->findById($id);
        if (!$order) {
            return redirect()->route('orders.index')->with('error', 'Commande non trouvée.');
        }
        $this->orderRepository->delete($order); // Soft delete
        return redirect()->route('orders.index')->with('success', 'Commande supprimée avec succès.');
    }
}