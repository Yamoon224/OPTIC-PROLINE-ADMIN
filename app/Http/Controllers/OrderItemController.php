<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderItemRequest;
use App\Http\Requests\UpdateOrderItemRequest;
use App\Repositories\OrderItemRepositoryInterface;
use App\Repositories\OrderRepositoryInterface; // Pour récupérer les commandes
use App\Repositories\ProductRepositoryInterface; // Pour récupérer les produits

class OrderItemController extends Controller
{
    /**
     * L'instance du repository de l'élément de commande.
     *
     * @var OrderItemRepositoryInterface
     */
    protected $orderItemRepository;

    /**
     * L'instance du repository de la commande.
     *
     * @var OrderRepositoryInterface
     */
    protected $orderRepository;

    /**
     * L'instance du repository du produit.
     *
     * @var ProductRepositoryInterface
     */
    protected $productRepository;

    /**
     * Crée une nouvelle instance du contrôleur.
     *
     * @param OrderItemRepositoryInterface $orderItemRepository
     * @param OrderRepositoryInterface $orderRepository
     * @param ProductRepositoryInterface $productRepository
     * @return void
     */
    public function __construct(
        OrderItemRepositoryInterface $orderItemRepository,
        OrderRepositoryInterface $orderRepository,
        ProductRepositoryInterface $productRepository
    ) {
        $this->orderItemRepository = $orderItemRepository;
        $this->orderRepository = $orderRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * Affiche une liste des ressources.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $orderItems = $this->orderItemRepository->getAll();
        return view('order_items.index', compact('orderItems'));
    }

    /**
     * Affiche le formulaire de création d'une nouvelle ressource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $orders = $this->orderRepository->getAll();
        $products = $this->productRepository->getAll();
        return view('order_items.create', compact('orders', 'products'));
    }

    /**
     * Stocke une ressource nouvellement créée dans le stockage.
     *
     * @param StoreOrderItemRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreOrderItemRequest $request)
    {
        $this->orderItemRepository->create($request->validated());
        return redirect()->route('order_items.index')->with('success', 'Élément de commande créé avec succès.');
    }

    /**
     * Affiche la ressource spécifiée.
     *
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show(int $id)
    {
        $orderItem = $this->orderItemRepository->findById($id);
        if (!$orderItem) {
            return redirect()->route('order_items.index')->with('error', 'Élément de commande non trouvé.');
        }
        return view('order_items.show', compact('orderItem'));
    }

    /**
     * Affiche le formulaire d'édition de la ressource spécifiée.
     *
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit(int $id)
    {
        $orderItem = $this->orderItemRepository->findById($id);
        if (!$orderItem) {
            return redirect()->route('order_items.index')->with('error', 'Élément de commande non trouvé.');
        }
        $orders = $this->orderRepository->getAll();
        $products = $this->productRepository->getAll();
        return view('order_items.edit', compact('orderItem', 'orders', 'products'));
    }

    /**
     * Met à jour la ressource spécifiée dans le stockage.
     *
     * @param UpdateOrderItemRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateOrderItemRequest $request, int $id)
    {
        $orderItem = $this->orderItemRepository->findById($id);
        if (!$orderItem) {
            return redirect()->route('order_items.index')->with('error', 'Élément de commande non trouvé.');
        }
        $this->orderItemRepository->update($orderItem, $request->validated());
        return redirect()->route('order_items.index')->with('success', 'Élément de commande mis à jour avec succès.');
    }

    /**
     * Supprime la ressource spécifiée du stockage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        $orderItem = $this->orderItemRepository->findById($id);
        if (!$orderItem) {
            return redirect()->route('order_items.index')->with('error', 'Élément de commande non trouvé.');
        }
        $this->orderItemRepository->delete($orderItem); // Soft delete
        return redirect()->route('order_items.index')->with('success', 'Élément de commande supprimé avec succès.');
    }
}
