<?php

namespace App\Controller;

use App\Entity\Carrier;
use App\Entity\Client;
use App\Entity\Order;
use App\Entity\OrderProduct;
use App\Entity\Product;
use App\Form\OrderType;
use App\Repository\CarrierRepository;
use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Dompdf\Dompdf;
use Dompdf\Options;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/order')]
class OrderController extends AbstractController
{
    #[Route('/', name: 'app_order_index', methods: ['GET','POST'])]
    public function index(PaginatorInterface $paginator, Request $request, OrderRepository $orderRepository): Response
    {
        $searchorder = $request->query->get('searchorder'); 
        if ($searchorder) {
            $orders = $orderRepository->findByReferenceOrCustomerName($searchorder);
        } else {
            $orders = $orderRepository->findAll();
        }
        //dd($searchorder);
        $pagination = $paginator->paginate(
            $orders,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('order/index.html.twig', [
            'orders' => $pagination,
            'isCancelled' => false,
        ]);
    }

    #[Route('/cancelled', name: 'app_order_cancelled', methods: ['GET','POST'])]
    public function cancelledOrders(PaginatorInterface $paginator, Request $request, OrderRepository $orderRepository): Response
    {
        $searchorder = $request->query->get('searchorder');
        if ($searchorder) {
            $orders = $orderRepository->findByReferenceOrCustomerNameCancelledOrders($searchorder);
        } else {
            $orders = $orderRepository->findBy(['cancelled' => true]);
        }

        $pagination = $paginator->paginate(
            $orders,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('order/index.html.twig', [
            'orders' => $pagination,
            'isCancelled' => true,
        ]);
    }

    #[Route('/order/get-state/{id}', name: 'order_get_state', methods: ['GET'])]
    public function getState(Order $order): JsonResponse
    {
        return new JsonResponse(['state' => $order->isState()]);
    }

    #[Route('/cancel/{id}', name: 'order_cancel', methods: ['POST'])]
    public function cancelOrder(Request $request, $id,EntityManagerInterface $em): JsonResponse
    {
        $order = $em->getRepository(Order::class)->find($id);

        if (!$order) {
            return new JsonResponse(['success' => false, 'message' => 'Commande introuvable.'], 404);
        }

        if ($order->isCancelled()) {
            return new JsonResponse(['success' => false, 'message' => 'La commande a déjà été annulée.'], 400);
        }

        if ($order->isDelivered()) {
            return new JsonResponse(['success' => false, 'message' => 'La commande est déjà livrée et ne peut pas être annulée.'], 400);
        }

        $data = json_decode($request->getContent(), true);
        $order->setCancelled(true);
        $order->setCancelReason($data['reason']);

        $em->flush();

        return new JsonResponse(['success' => true]);
    }



    #[Route('/new', name: 'app_order_new', methods: ['POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $cartWrapper = $data['cart'] ?? null; 
        $username = $data['username'] ?? null; 
        if (!$cartWrapper || !isset($cartWrapper['cart']) || !is_array($cartWrapper['cart'])) {
            return new JsonResponse(['error' => 'Invalid cart data'], Response::HTTP_BAD_REQUEST);
        }

        if (!$username) {
            return new JsonResponse(['error' => 'Username is required'], Response::HTTP_BAD_REQUEST);
        }

        $cartData = $cartWrapper['cart'];

        // Rechercher le client
        $client = $entityManager->getRepository(Client::class)->findOneBy(['email' => $username]);
        if (!$client) {
            return new JsonResponse('Client not found', Response::HTTP_NOT_FOUND);
        }

        $order = new Order();
        $order->setReference(uniqid('order_')); // Générer une référence unique
        $order->setOrdernumber(random_int(100000, 999999)); // Générer un numéro d'ordre unique
        $order->setClient($client);

        $total = 0;

        foreach ($cartData as $cartItem) {
            if (!isset($cartItem['product_id']) || !isset($cartItem['quantity'])) {
                return new JsonResponse(['error' => 'Invalid cart item format'], Response::HTTP_BAD_REQUEST);
            }

            // Rechercher le produit
            $product = $entityManager->getRepository(Product::class)->find($cartItem['product_id']);
            if (!$product) {
                return new JsonResponse(['error' => "Product with ID {$cartItem['product_id']} not found"], Response::HTTP_NOT_FOUND);
            }
            $orderProduct = new OrderProduct();
            $orderProduct->setProduct($product);
            $orderProduct->setQuantity(1);

            $order->addOrderProduct($orderProduct);

            // Calculer le sous-total pour cet article
            $subtotal = $product->getPrixVenteTtc() * $cartItem['quantity'];
            $total += $subtotal;
        }

        // Définir le total dans l'entité `Order`
        $order->setTotal($total);

        // Persister et sauvegarder la commande
        $entityManager->persist($order);
        $entityManager->flush();

        return new JsonResponse([
            'message' => 'Order created successfully',
            'order_id' => $order->getId(),
            'reference' => $order->getReference(),
            'total' => $order->getTotal(),
        ], Response::HTTP_CREATED);
    }

    /**
     * @Route("/order/{id}/toggle-payment", name="admin_order_toggle_payment")
     */
    public function togglePayment(Order $order,EntityManagerInterface $entityManager): Response
    {
        // Vérification si la commande peut être modifiée
        if ($order->isCancelled()) {
            $this->addFlash('error', 'La commande est annulée et ne peut pas être modifiée.');
            return $this->redirectToRoute('app_order_show', ['id' => $order->getId()]);
        }

        // Changer le statut de paiement
        $order->setPaid(!$order->isPaid()); // Inverser l'état du paiement
        $entityManager->flush();

        // Afficher un message de succès
        $this->addFlash('success', 'Statut de paiement mis à jour avec succès.');

        // Rediriger vers la page de la commande
        return $this->redirectToRoute('app_order_show', ['id' => $order->getId()]);
    }

    #[Route('/{id}', name: 'app_order_show', methods: ['GET'])]
    public function show(Order $order, CarrierRepository $carrierRepository): Response
    {
        $carriers = $carrierRepository->findAll();
        //dd($order->getOrderProduct());
        return $this->render('order/show.html.twig', [
            'order' => $order,
            'carriers' => $carriers
        ]);
    }

    #[Route('/{id}/assign-carrier', name: 'app_order_assign_carrier', methods: ['POST'])]
    public function assignCarrier(
        Request $request,
        Order $order,
        EntityManagerInterface $entityManager,
        CarrierRepository $carrierRepository
    ): JsonResponse {
        $data = json_decode($request->getContent(), true);

        // Vérifiez si un ID de livreur est fourni
        if (!isset($data['carrierId'])) {
            return new JsonResponse(['success' => false, 'message' => 'ID du livreur manquant.'], Response::HTTP_BAD_REQUEST);
        }

        // Trouver le livreur correspondant
        $carrier = $carrierRepository->find($data['carrierId']);
        if (!$carrier) {
            return new JsonResponse(['success' => false, 'message' => 'Livreur non trouvé.'], Response::HTTP_NOT_FOUND);
        }

        // Affecter le livreur à la commande
        $order->setCarrier($carrier);
        $entityManager->persist($order);
        $entityManager->flush();

        return new JsonResponse([
            'success' => true,
            'carrierName' => $carrier->getName(),
        ]);
    }

    /**
     * @Route("/admin/order/{id}/set-delivery-date", name="app_order_set_delivery_date", methods={"POST"})
     */
    public function setDeliveryDate(Request $request, Order $order, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!isset($data['deliveryDate']) || empty($data['deliveryDate'])) {
            return new JsonResponse(['error' => 'Date de livraison non spécifiée.'], 400);
        }

        try {
            $deliveryDate = new \DateTime($data['deliveryDate']);
            $order->setDeliveryDate($deliveryDate); // Assurez-vous que l'entité Order a un champ `deliveryDate`
            $entityManager->flush();

            return new JsonResponse(['message' => 'Date de livraison mise à jour avec succès.']);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'Erreur lors de la mise à jour : ' . $e->getMessage()], 500);
        }
    }
    
    #[Route('/order/{id}/update-payment-method', name: 'admin_order_update_payment_method', methods: ['POST'])]
    public function updatePaymentMethod(Order $order, Request $request,EntityManagerInterface $entityManager): Response
    {
        // Vérification si la commande est déjà annulée ou non
        if ($order->isCancelled()) {
            $this->addFlash('error', 'La commande est annulée et ne peut pas être modifiée.');
            return $this->redirectToRoute('app_order_show', ['id' => $order->getId()]);
        }

        // Récupérer le mode de paiement envoyé par le formulaire
        $paymentMethod = $request->request->get('paymentMethod');

        // Mettre à jour le mode de paiement
        $order->setPaymentMethod($paymentMethod);
        $entityManager->flush();

        // Afficher un message de succès
        $this->addFlash('success', 'Mode de paiement mis à jour avec succès.');

        // Rediriger vers la page des détails de la commande
        return $this->redirectToRoute('app_order_show', ['id' => $order->getId()]);
    }


    #[Route('/{id}/edit', name: 'app_order_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Order $order, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(OrderType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_order_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('order/edit.html.twig', [
            'order' => $order,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_order_delete', methods: ['POST'])]
    public function delete(Request $request, Order $order, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$order->getId(), $request->request->get('_token'))) {
            $entityManager->remove($order);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_order_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/generate-invoice', name: 'admin_order_generate_invoice')]
    public function generateInvoice(Order $order, EntityManagerInterface $entityManager): Response
    {
        // Vérifier si la commande possède un livreur
        if (!$order->getCarrier()) {
            $this->addFlash('error', 'La commande doit être associée à un livreur pour générer une facture.');
            return $this->redirectToRoute('app_order_show', ['id' => $order->getId()]);
        }

        // Vérifier si la facture a déjà été générée
        if ($order->isInvoiceGenerated()) {
            $this->addFlash('error', 'Une facture a déjà été générée pour cette commande.');
            return $this->redirectToRoute('app_order_show', ['id' => $order->getId()]);
        }
        $billReference = 'FACT-' . strtoupper(uniqid()) . '-' . $order->getId();
        $order->setBillreference($billReference);
        // Générer la facture
        $pdfContent = $this->generateInvoicePdf($order);

        $invoiceDir = $this->getParameter('kernel.project_dir') . '/public/invoices/';
        if (!file_exists($invoiceDir)) {
            mkdir($invoiceDir, 0777, true);
        }

        $filePath = $invoiceDir . 'facture_' . $order->getBillreference() . '.pdf';

        // Sauvegarder le fichier PDF
        file_put_contents($filePath, $pdfContent);

        // Marquer la facture comme générée
        $order->setInvoiceGenerated(true);
        $entityManager->flush();

        // Retourner le PDF pour téléchargement
        return new Response($pdfContent, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="facture_' . $order->getReference() . '.pdf"',
        ]);
    }


    private function generateInvoicePdf(Order $order): string
    {
        $dompdf = new \Dompdf\Dompdf();
        $html = $this->renderView('order/invoice.html.twig', [
            'order' => $order,
        ]);
        $dompdf->loadHtml($html);
        $dompdf->render();

        return $dompdf->output();
    }

    #[Route('/admin/orders/{id}/download-invoice', name: 'admin_order_download_invoice')]
    public function downloadInvoice(Order $order): Response
    {
        $filePath = $this->getParameter('kernel.project_dir') . '/public/invoices/facture_' . $order->getBillreference() . '.pdf';

        if (!file_exists($filePath)) {
            $this->addFlash('danger', 'Le fichier de la facture est introuvable.');
            return $this->redirectToRoute('admin_order_generate_invoice', ['id' => $order->getId()]);
        }

        return $this->file($filePath, 'facture_' . $order->getBillreference() . '.pdf');
    }


    #[Route('/admin/invoices', name: 'admin_invoices')]
    public function listInvoices(OrderRepository $orderRepository): Response
    {
        // Récupérer les commandes ayant une facture générée
        $ordersWithInvoices = $orderRepository->findBy(['invoiceGenerated' => true]);

        return $this->render('order/invoices.html.twig', [
            'orders' => $ordersWithInvoices,
        ]);
    }

    #[Route('/api/order/{id}/pdf', name: 'api_order_pdf', methods: ['GET'])]
    public function generatePdf($id, EntityManagerInterface $em): Response
    {
        $order = $em->getRepository(Order::class)->find($id);

        if (!$order) {
            return new Response('Order not found', 404);
        }

        // Configuration de Dompdf
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($options);

        // Générer le HTML
        $html = $this->renderView('order/pdf.html.twig', [
            'order' => $order,
        ]);

        // Charger le HTML dans Dompdf
        $dompdf->loadHtml($html);

        // (Optionnel) Configurer la taille du papier et l'orientation
        $dompdf->setPaper('A4', 'portrait');

        // Générer le PDF
        $dompdf->render();

        // Retourner le PDF en réponse
        return new Response(
            $dompdf->output(),
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="order_' . $order->getId() . '.pdf"',
            ]
        );
    }
}

