<?php

namespace App\Controller;

use App\Entity\CarrierPrice;
use App\Form\CarrierPriceType;
use App\Repository\CarrierPriceRepository;
use App\Repository\CarrierRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/carrier/price')]
class CarrierPriceController extends AbstractController
{
    #[Route('/index/{id}', name: 'app_carrier_price_index', methods: ['GET'])]
    public function index(Request $request ,int $id, CarrierPriceRepository $carrierPriceRepository, PaginatorInterface $paginator): Response
    {
        // Utiliser la méthode personnalisée pour récupérer les CarrierPrice associés au Carrier
        $carrierPrices = $carrierPriceRepository->findByCarrier($id);
        $pagination = $paginator->paginate(
            $carrierPrices,
            $request->query->getInt('page', 1), 
            10
        );
        return $this->render('carrier_price/index.html.twig', [
            'carrier_prices' => $pagination,
            'carrier_id' => $id,
        ]);
    }

    #[Route('/new/{id_carrier}', name: 'app_carrier_price_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager,int $id_carrier, CarrierRepository $carrierRepository): Response
    {
        //var_dump(value: $id_carrier);die;
        $carrierPrice = new CarrierPrice();
        $form = $this->createForm(CarrierPriceType::class, $carrierPrice);
        $form->handleRequest($request);
        $carrierPrice->setCarrier($carrierRepository->find($id_carrier));

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($carrierPrice);
            $entityManager->flush();

            return $this->redirectToRoute('app_carrier_price_index', ['id' => $id_carrier], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('carrier_price/new.html.twig', parameters: [
            'carrier_price' => $carrierPrice,
            'form' => $form,
            'idCarrier'=>$id_carrier,
        ]);
    }

    #[Route('/{id}', name: 'app_carrier_price_show', methods: ['GET'])]
    public function show(CarrierPrice $carrierPrice): Response
    {
        return $this->render('carrier_price/show.html.twig', [
            'carrier_price' => $carrierPrice,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_carrier_price_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CarrierPrice $carrierPrice, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CarrierPriceType::class, $carrierPrice);
        $form->handleRequest($request);
        $carrierid= $carrierPrice->getCarrier()->getId();
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_carrier_price_index', parameters: ['id' =>$carrierid], status: Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('carrier_price/edit.html.twig', [
            'carrier_price' => $carrierPrice,
            'form' => $form,
            'carrierid'=>$carrierid,
        ]);
    }

    #[Route('/{id}', name: 'app_carrier_price_delete', methods: ['POST'])]
    public function delete(Request $request, CarrierPrice $carrierPrice, EntityManagerInterface $entityManager): Response
    {
        $carrierid = $carrierPrice->getCarrier()->getId();
        if ($this->isCsrfTokenValid('delete'.$carrierPrice->getId(), $request->request->get('_token'))) {
            $entityManager->remove($carrierPrice);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_carrier_price_index', ['id'=>$carrierid], Response::HTTP_SEE_OTHER);
    }
}
