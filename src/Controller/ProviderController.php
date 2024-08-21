<?php

namespace App\Controller;

use App\Entity\Provider;
use App\Form\ProviderType;
use App\Repository\ProviderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/provider')]
class ProviderController extends AbstractController
{
    #[Route('/', name: 'app_provider_index', methods: ['GET','POST'])]
    public function index(PaginatorInterface $paginator, Request $request,ProviderRepository $providerRepository): Response
    {
        $searchprovider = $request->request->get('searchprovider');
        if ($searchprovider) {
            $providers = $providerRepository->findByLikeName($searchprovider);
        } else {
            $providers = $providerRepository->findAll();
        }
        $pagination = $paginator->paginate(
            $providers,
            $request->query->getInt('page', 1), 
            10
        );
        return $this->render('provider/index.html.twig', [
            'providers' => $pagination,
        ]);
    }

    #[Route('/new', name: 'app_provider_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $provider = new Provider();
        $form = $this->createForm(ProviderType::class, $provider);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($provider);
            $entityManager->flush();

            return $this->redirectToRoute('app_provider_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('provider/new.html.twig', [
            'provider' => $provider,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_provider_show', methods: ['GET'])]
    public function show(Provider $provider): Response
    {
        return $this->render('provider/show.html.twig', [
            'provider' => $provider,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_provider_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Provider $provider, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProviderType::class, $provider);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_provider_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('provider/edit.html.twig', [
            'provider' => $provider,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_provider_delete', methods: ['POST'])]
    public function delete(Request $request, Provider $provider, EntityManagerInterface $entityManager): Response
    {
        // Dans votre méthode de suppression du fournisseur
        foreach ($provider->getProducts() as $product) {
            $product->setProvider(null);
        }
        $entityManager->flush();
        if ($this->isCsrfTokenValid('delete'.$provider->getId(), $request->request->get('_token'))) {
            $entityManager->remove($provider);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_provider_index', [], Response::HTTP_SEE_OTHER);
    }
}
