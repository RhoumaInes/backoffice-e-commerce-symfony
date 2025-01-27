<?php

namespace App\Controller;

use App\Entity\Carrier;
use App\Entity\CarrierPrice;
use App\Entity\Order;
use App\Form\CarrierType;
use App\Repository\CarrierRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/')]
class CarrierController extends AbstractController
{
    #[Route('admin/carrier/', name: 'app_carrier_index', methods: ['GET'])]
    public function index(CarrierRepository $carrierRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $searchcarrier = $request->request->get('searchcarrier');
        if ($searchcarrier) {
            $carrier = $carrierRepository->findByLikeName($searchcarrier);
        } else {
            $carrier = $carrierRepository->findAll();
        }
        $pagination = $paginator->paginate(
            $carrier,
            $request->query->getInt('page', 1), 
            10
        );
        return $this->render('carrier/index.html.twig', [
            'carriers' => $pagination,
        ]);
    }

    #[Route('admin/carrier/new', name: 'app_carrier_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $carrier = new Carrier();
        $form = $this->createForm(CarrierType::class, $carrier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($carrier);
            $entityManager->flush();

            return $this->redirectToRoute('app_carrier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('carrier/new.html.twig', [
            'carrier' => $carrier,
            'form' => $form,
        ]);
    }

    #[Route('admin/carrier/{id}', name: 'app_carrier_show', methods: ['GET'])]
    public function show(Carrier $carrier): Response
    {
        return $this->render('carrier/show.html.twig', [
            'carrier' => $carrier,
        ]);
    }

    #[Route('admin/carrier/{id}/edit', name: 'app_carrier_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Carrier $carrier, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CarrierType::class, $carrier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_carrier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('carrier/edit.html.twig', [
            'carrier' => $carrier,
            'form' => $form,
        ]);
    }

    #[Route('admin/carrier/toggle/{id}', name: 'toggle_carrier', methods: ['POST'])]
    public function toggleTaxState(int $id, Request $request, EntityManagerInterface $em): JsonResponse
    {
        $carrier = $em->getRepository(Carrier::class)->find($id);

        if (!$carrier) {
            return new JsonResponse(['success' => false, 'error' => 'Carrier not found'], 404);
        }

        $data = json_decode($request->getContent(), true);
        $carrier->setState($data['state']);
        $em->flush();

        return new JsonResponse(['success' => true]);
    }

    #[Route('admin/carrier/{id}', name: 'app_carrier_delete', methods: ['POST'])]
    public function delete(Request $request, Carrier $carrier, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$carrier->getId(), $request->request->get('_token'))) {
            $entityManager->remove($carrier);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_carrier_index', [], Response::HTTP_SEE_OTHER);
    }
  
    #[Route('/api/carriers', name: 'api_carriers', methods: ['GET'])]
    public function getCarriers(CarrierRepository $carrierRepository): JsonResponse
    {
        $carriers = $carrierRepository->findAll();
        $data = [];

        foreach ($carriers as $carrier) {
            $cities = [];
            foreach ($carrier->getCarrierPrices() as $price) {
                $cities[] = [
                    'city' => $price->getCity(),
                    'price' => $price->getPrice(),
                ];
            }

            $data[] = [
                'id' => $carrier->getId(),
                'name' => $carrier->getName(),
                'cities' => $cities,
            ];
        }

        return $this->json($data);
    }

    #[Route('/api/submit-delivery', name: 'api_submit_delivery', methods: ['POST'])]
    public function submitDelivery(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $carrierId = $request->request->get('carrier_id');
        $city = $request->request->get('city_id');
        $address = $request->request->get('address');
        $totalPrice = $request->request->get('total_price');

        $carrier = $entityManager->getRepository(Carrier::class)->find($carrierId);
        $carrierPrice = $entityManager->getRepository(CarrierPrice::class)->find($city);
        if (!$carrier) {
            return $this->json(['error' => 'Carrier not found'], 404);
        }

        // Mettre à jour la commande
        $order = new Order();
        $order->setCarrier($carrier);
        $order->setCarrierPrice($carrierPrice);
        $order->setAddress($address);
        $order->setTotal($totalPrice);

        $entityManager->persist($order);
        $entityManager->flush();

        return $this->json(['message' => 'Delivery details saved successfully']);
    }


}
