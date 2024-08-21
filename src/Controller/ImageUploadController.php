<?php

namespace App\Controller;

use App\Entity\Imagesproduct;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ImageUploadController extends AbstractController
{
    #[Route('/image/upload', name: 'app_image_upload')]
    public function index(): Response
    {
        return $this->render('image_upload/index.html.twig', [
            'controller_name' => 'ImageUploadController',
        ]);
    }

    #[Route('/product/image/upload', name: 'app_image_upload_product')]
    public function uploadForProduct(): Response
    {
        return $this->render('image_upload/upload.html.twig', [
            'controller_name' => 'ImageUploadController',
        ]);
    }
    
    #[Route('/upload_image', name:'upload_image', methods: ['POST'])]
    public function uploadImage(Request $request)
    {
        //return new JsonResponse(['msg' => $request->files->get('file')], 200);
        $file = $request->files->get('file');

        if ($file) {
            $filename = uniqid() . '.' . $file->guessExtension();
            
            try {
                // Déplace le fichier dans le répertoire spécifié
                $file->move($this->getParameter('uploads_directory'), $filename);
                //return new JsonResponse(['msg' => $this->generateUrl('home', [], true)]);
                // Génère l'URL de l'image
                $url =  '/uploads/' . $filename;
                
                return new JsonResponse(['url' => $url]);
            } catch (FileException $e) {
                return new JsonResponse(['error' => 'Failed to upload image'], 500);
            }
        }

        return new JsonResponse(['error' => 'No file provided'], 400);
    }

    #[Route('/file_upload', name: 'file_upload', methods: ['POST'])]
    public function upload(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        /** @var UploadedFile $file */
        $file = $request->files->get('file');
        $productId = $request->request->get('product_id');

        if ($file && $productId) {
            $filename = uniqid() . '.' . $file->guessExtension();

            try {
                $file->move($this->getParameter('uploads_directory'), $filename);

                // Find the product
                $product = $entityManager->getRepository(Product::class)->find($productId);
                if (!$product) {
                    return new JsonResponse(['error' => 'Product not found'], 404);
                }

                // Create and save the image entity
                $image = new Imagesproduct();
                $image->setFilename($filename);
                $image->setProduct($product);

                $entityManager->persist($image);
                $entityManager->flush();

                return new JsonResponse(['url' => '/uploads/' . $filename], 200);
            } catch (FileException $e) {
                return new JsonResponse(['error' => 'Failed to upload file'], 500);
            }
        }

        return new JsonResponse(['error' => 'No file or product ID provided'], 400);
    }
    #[Route('/image/{id}/delete', name: 'image_delete', methods: ['POST'])]
    public function deleteImage(Imagesproduct $image, EntityManagerInterface $em): Response
    {
        $filesystem = new Filesystem();
        $filePath = $this->getParameter('uploads_directory') . '/' . $image->getFilename();

        // Supprimer le fichier du système de fichiers
        if ($filesystem->exists($filePath)) {
            $filesystem->remove($filePath);
        }

        // Supprimer l'entité Image de la base de données
        $product = $image->getProduct();
        $productId = $product->getId();
        $em->remove($image);
        $em->flush();
        return $this->redirectToRoute('app_product_edit', ['id' => $productId], Response::HTTP_SEE_OTHER);
    }


}
