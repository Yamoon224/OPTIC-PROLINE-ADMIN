<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Repositories\PaymentRepositoryInterface;
use App\Repositories\OrderRepositoryInterface; // Pour récupérer les commandes

class PaymentController extends Controller
{
    /**
     * L'instance du repository du paiement.
     *
     * @var PaymentRepositoryInterface
     */
    protected $paymentRepository;

    /**
     * L'instance du repository de la commande.
     *
     * @var OrderRepositoryInterface
     */
    protected $orderRepository;

    /**
     * Crée une nouvelle instance du contrôleur.
     *
     * @param PaymentRepositoryInterface $paymentRepository
     * @param OrderRepositoryInterface $orderRepository
     * @return void
     */
    public function __construct(PaymentRepositoryInterface $paymentRepository, OrderRepositoryInterface $orderRepository)
    {
        $this->paymentRepository = $paymentRepository;
        $this->orderRepository = $orderRepository;
    }

    /**
     * Affiche une liste des ressources.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $payments = $this->paymentRepository->getAll();
        return view('admin.payments.index', compact('payments'));
    }

    /**
     * Affiche le formulaire de création d'une nouvelle ressource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $orders = $this->orderRepository->getAll();
        return view('admin.payments.create', compact('orders'));
    }

    /**
     * Stocke une ressource nouvellement créée dans le stockage.
     *
     * @param StorePaymentRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StorePaymentRequest $request)
    {
        $this->paymentRepository->create($request->validated());
        return redirect()->route('payments.index')->with('success', 'Paiement créé avec succès.');
    }

    /**
     * Affiche la ressource spécifiée.
     *
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show(int $id)
    {
        $payment = $this->paymentRepository->findById($id);
        if (!$payment) {
            return redirect()->route('payments.index')->with('error', 'Paiement non trouvé.');
        }
        return view('admin.payments.show', compact('payment'));
    }

    /**
     * Affiche le formulaire d'édition de la ressource spécifiée.
     *
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit(int $id)
    {
        $payment = $this->paymentRepository->findById($id);
        if (!$payment) {
            return redirect()->route('payments.index')->with('error', 'Paiement non trouvé.');
        }
        $orders = $this->orderRepository->getAll();
        return view('admin.payments.edit', compact('payment', 'orders'));
    }

    /**
     * Met à jour la ressource spécifiée dans le stockage.
     *
     * @param UpdatePaymentRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdatePaymentRequest $request, int $id)
    {
        $payment = $this->paymentRepository->findById($id);
        if (!$payment) {
            return redirect()->route('payments.index')->with('error', 'Paiement non trouvé.');
        }
        $this->paymentRepository->update($payment, $request->validated());
        return redirect()->route('payments.index')->with('success', 'Paiement mis à jour avec succès.');
    }

    /**
     * Supprime la ressource spécifiée du stockage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        $payment = $this->paymentRepository->findById($id);
        if (!$payment) {
            return redirect()->route('payments.index')->with('error', 'Paiement non trouvé.');
        }
        $this->paymentRepository->delete($payment); // Soft delete
        return redirect()->route('payments.index')->with('success', 'Paiement supprimé avec succès.');
    }
}
