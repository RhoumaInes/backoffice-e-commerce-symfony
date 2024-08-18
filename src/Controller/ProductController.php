<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\CategorieRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/product')]
class ProductController extends AbstractController
{
    #[Route('/', name: 'app_product_index', methods: ['GET','POST'])]
    public function index(PaginatorInterface $paginator, Request $request, ProductRepository $productRepository): Response
    {
        $searchproduct = $request->request->get('searchproduct');
        if ($searchproduct) {
            $prods = $productRepository->findByLikeName($searchproduct);
        } else {
            $prods = $productRepository->findAll();
        }
        $pagination = $paginator->paginate(
            $prods,
            $request->query->getInt('page', 1), 
            10
        );
        return $this->render('product/index.html.twig', [
            'products' => $pagination,
        ]);
    }

    #[Route('/categorie/{id}/products', name: 'app_category_products', methods: ['GET','POST'])]
    public function listProductsByCategory(PaginatorInterface $paginator, Request $request, $id, ProductRepository $productRepository, CategorieRepository $categorieRepository): Response
    {
        // Récupérer la catégorie
        $category = $categorieRepository->find($id);
        if (!$category) {
            throw $this->createNotFoundException('La catégorie n\'existe pas.');
        }
        // Récupérer les produits de la catégorie
        $products = $category->getProducts();
        $pagination = $paginator->paginate(
            $products,
            $request->query->getInt('page', 1), 
            10
        );

        return $this->render('product/index.html.twig', [
            'category' => $category,
            'products' => $pagination,
        ]);
    }

    #[Route('/new', name: 'app_product_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {            
            $product->setUser($this->getUser());
            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('app_product_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('product/new.html.twig', [
            'product' => $product,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_product_show', methods: ['GET'])]
    public function show(Product $product): Response
    {
        return $this->render('product/show.html.twig', [
            'product' => $product,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_product_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Product $product, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_product_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('product/edit.html.twig', [
            'product' => $product,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_product_delete', methods: ['POST'])]
    public function delete(Request $request, Product $product, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token'))) {
            $entityManager->remove($product);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_product_index', [], Response::HTTP_SEE_OTHER);
    }
}
