<?php

namespace App\Controller;

use App\Entity\Carrier;
use App\Entity\Client;
use App\Entity\Order;
use App\Entity\Product;
use App\Form\OrderType;
use App\Repository\CarrierRepository;
use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;
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
        $searchorder = $request->query->get('searchorder'); // Utilisez `query` au lieu de `request` pour une recherche via GET
        if ($searchorder) {
            $orders = $orderRepository->findByReferenceOrCustomerName($searchorder);
        } else {
            $orders = $orderRepository->findAll();
        }

        $pagination = $paginator->paginate(
            $orders,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('order/index.html.twig', [
            'orders' => $pagination,
        ]);
    }

    #[Route('/order/get-state/{id}', name: 'order_get_state', methods: ['GET'])]
    public function getState(Order $order): JsonResponse
    {
        return new JsonResponse(['state' => $order->isState()]);
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

            // Ajouter le produit à la commande
            $order->addProduct(product: $product);

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
}

