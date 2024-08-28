<?php

namespace App\Controller;

use App\Entity\Attribute;
use App\Entity\Categorie;
use App\Entity\Imagesproduct;
use App\Entity\Product;
use App\Form\ProductPricingType;
use App\Form\ProductType;
use App\Repository\CategorieRepository;
use App\Repository\ProductRepository;
use App\Repository\ProviderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

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
            $prods = $productRepository->findAllWithFirstImage();
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

    #[Route('/provider/{id}/products', name: 'app_provider_products', methods: ['GET','POST'])]
    public function listProductsByProvider(PaginatorInterface $paginator, Request $request, $id, ProviderRepository $providerRepository): Response
    {
        // Récupérer la catégorie
        $provider = $providerRepository->find($id);
        if (!$provider) {
            throw $this->createNotFoundException('Le fournisseur n\'existe pas.');
        }
        // Récupérer les produits de la catégorie
        $products = $provider->getProducts();
        $pagination = $paginator->paginate(
            $products,
            $request->query->getInt('page', 1), 
            10
        );

        return $this->render('product/index.html.twig', [
            'provider' => $provider,
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
        $pricingForm = $this->createForm(ProductPricingType::class, $product);

        $form->handleRequest($request);
        $pricingForm->handleRequest($request);

        // Charger les images existantes
        $images = $entityManager->getRepository(Imagesproduct::class)->findBy(['Product' => $product]);
        $categories = $entityManager->getRepository(Categorie::class)->findAll();
        $attributes = $entityManager->getRepository(Attribute::class)->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('app_product_index', [], Response::HTTP_SEE_OTHER);
        }

        if ($pricingForm->isSubmitted() && $pricingForm->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('app_product_edit', ['id' => $product->getId()], Response::HTTP_SEE_OTHER);
        }

        if ($request->isMethod('POST')) {
            $file = $request->files->get('file');

            if ($file) {
                $filename = uniqid() . '.' . $file->guessExtension();
                $file->move($this->getParameter('uploads_directory'), $filename);

                $image = new Imagesproduct();
                $image->setFilename($filename);
                $image->setProduct($product);
                $entityManager->persist($image);
                $entityManager->flush();

                return new JsonResponse(['url' => '/uploads/' . $filename], 200);
            }

            return new JsonResponse(['error' => 'No file provided'], 400);
        }

        return $this->renderForm('product/edit.html.twig', [
            'product' => $product,
            'form' => $form,
            'pricingForm' => $pricingForm,
            'images' => $images,
            'categories' => $categories,
            'attributes' => $attributes,
        ]);
    }

    #[Route('/{id}/update_category', name: 'product_update_category', methods: ['POST'])]
    public function updateCategory(Product $product, Request $request, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $categoryId = $data['category_id'];
        $add = $data['add'];

        $category = $em->getRepository(Categorie::class)->find($categoryId);

        if ($category) {
            if ($add) {
                $product->addCategory($category);
            } else {
                $product->removeCategory($category);
            }

            $em->flush();

            return new JsonResponse(['success' => true]);
        }

        return new JsonResponse(['success' => false], Response::HTTP_BAD_REQUEST);
    }

    #[Route('/{id}/update_attributs', name: 'product_update_attributs', methods: ['POST'])]
    public function updateAttributs(Product $product, Request $request, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $attributId = $data['attribut_id'];
        $add = $data['add'];

        $attribut = $em->getRepository(Attribute::class)->find($attributId);

        if ($attribut) {
            if ($add) {
                $product->addAttribute($attribut);
            } else {
                $product->removeAttribute($attribut);
            }

            $em->flush();

            return new JsonResponse(['success' => true]);
        }

        return new JsonResponse(['success' => false], Response::HTTP_BAD_REQUEST);
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
