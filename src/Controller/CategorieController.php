<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class CategorieController extends AbstractController
{
    #[Route('/admin/categorie', name: 'app_categorie_index', methods: ['GET','POST'])]
    public function index(PaginatorInterface $paginator,Request $request,CategorieRepository $categorieRepository): Response
    {
        $searchcategorie = $request->request->get('searchcategorie');
        if ($searchcategorie) {
            $categories = $categorieRepository->findByLikeName($searchcategorie);
        } else {
            $categories = $categorieRepository->findAll();
        }
        $pagination = $paginator->paginate(
            $categories,
            $request->query->getInt('page', 1), 
            10
        );
        return $this->render('categorie/index.html.twig', [
            'categories' => $pagination,
        ]);
    }

    #[Route('/api/categories', name: 'get_categories', methods: ['GET'])]
    public function getCategories(CategorieRepository $categoryRepository): JsonResponse
    {
        $categories = $categoryRepository->findAll();
        // Convertir les catégories en tableau ou en JSON
        $data = []; 
        foreach ($categories as $category) {
            $data[] = [
                'id' => $category->getId(),
                'name' => $category->getName(),
                'sections' => [
                    // Ajouter les sections liées à cette catégorie
                ]
            ];
        }
        return new JsonResponse([
            'success' => true,
            'categories' => $data
        ], 200);
    }

    #[Route('/admin/categorie/new', name: 'app_categorie_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $categorie = new Categorie();
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($categorie);
            $entityManager->flush();

            return $this->redirectToRoute('app_categorie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categorie/new.html.twig', [
            'categorie' => $categorie,
            'form' => $form,
        ]);
    }

    #[Route('/admin/categorie/{id}', name: 'app_categorie_show', methods: ['GET'])]
    public function show(Categorie $categorie): Response
    {
        return $this->render('categorie/show.html.twig', [
            'categorie' => $categorie,
        ]);
    }

    #[Route('/admin/categorie/{id}/edit', name: 'app_categorie_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Categorie $categorie, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_categorie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categorie/edit.html.twig', [
            'categorie' => $categorie,
            'form' => $form,
        ]);
    }

    #[Route('/admin/categorie/{id}', name: 'app_categorie_delete', methods: ['POST'])]
    public function delete(Request $request, Categorie $categorie, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categorie->getId(), $request->request->get('_token'))) {
            $entityManager->remove($categorie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_categorie_index', [], Response::HTTP_SEE_OTHER);
    }
}
