<?php

namespace App\Controller;

use App\Entity\Attribute;
use App\Entity\AttributeValue;
use App\Enum\AttributeType;
use App\Form\AttributeValueType;
use App\Repository\AttributeRepository;
use App\Repository\AttributeValueRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/attribute/value')]
class AttributeValueController extends AbstractController
{
    #[Route('/{id_attribute}', name: 'app_attribute_value_index', methods: ['GET'])]
    public function index(Request $request, AttributeValueRepository $attributeValueRepository, PaginatorInterface $paginator , AttributeRepository $attributeRepository): Response
    {
        $attribute = $attributeRepository->findOneBy(['id' => $request->attributes->get('id_attribute')]);
        $pagination = $paginator->paginate(
            $attributeValueRepository->findByAttribute($attribute),
            $request->query->getInt('page', 1), 
            10
        );
        return $this->render('attribute_value/index.html.twig', [
            'attribute_values' => $pagination,
            'attribute' => $attribute,
        ]);
    }

    #[Route('/new/{id_attribute}', name: 'app_attribute_value_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, AttributeRepository $attributeRepository): Response
    {
        $attribute = $attributeRepository->findOneBy(['id' => $request->attributes->get('id_attribute')]);
        //dump($attribute);die;
        $attributeValue = new AttributeValue();
        $attributeValue->setAttribute($attribute);

        // Get all attributes and their types
        $allAttributes = $attributeRepository->findAll();
        $attributeTypes = [];
        foreach ($allAttributes as $attr) {
            $attributeTypes[$attr->getId()] = $attr->getType()->value; // Get type as string
        }

        $form = $this->createForm(AttributeValueType::class, $attributeValue, [
            'selected_attribute' => $attribute, // Pass the selected attribute to the form
        ]);
        $colorType = AttributeType::COLOR->value;
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($attribute->getType() === AttributeType::COLOR) {
                $attributeValue->setColor(null);
            }
            $entityManager->persist($attributeValue);
            $entityManager->flush();
            // Recréez un nouvel objet AttributeValue pour un nouveau formulaire
            $attributeValue = new AttributeValue();
            $attributeValue->setAttribute($attribute);

            // Recréez le formulaire
            $form = $this->createForm(AttributeValueType::class, $attributeValue, [
                'selected_attribute' => $attribute, // Repasser l'attribut sélectionné
            ]);

            return $this->render('attribute_value/new.html.twig', [
                'attribute_value' => $attributeValue,
                'form' => $form->createView(),
                'colorType' => $colorType,
                'attributeTypes' => json_encode($attributeTypes),
            ]);
            //return $this->redirectToRoute('app_attribute_value_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('attribute_value/new.html.twig', [
            'attribute_value' => $attributeValue,
            'form' => $form,
            'colorType' => $colorType,
            'attributeTypes' => json_encode($attributeTypes),
            'attribute' => $attribute,
        ]);
    }


    #[Route('/{id}', name: 'app_attribute_value_show', methods: ['GET'])]
    public function show(AttributeValue $attributeValue): Response
    {
        return $this->render('attribute_value/show.html.twig', [
            'attribute_value' => $attributeValue,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_attribute_value_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, AttributeValue $attributeValue, EntityManagerInterface $entityManager, AttributeRepository $attributeRepository): Response
    {
        $attribute = $attributeValue->getAttribute();

        // Obtenir tous les attributs et leurs types
        $allAttributes = $attributeRepository->findAll();
        $attributeTypes = [];
        foreach ($allAttributes as $attr) {
            $attributeTypes[$attr->getId()] = $attr->getType()->value; // Obtenir le type en tant que chaîne
        }
        $colorType = AttributeType::COLOR->value;
        // Créer le formulaire avec l'attribut sélectionné
        $form = $this->createForm(AttributeValueType::class, $attributeValue, [
            'selected_attribute' => $attribute,
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Obtenir le nouvel attribut sélectionné
            $newAttributeId = $form->get('attribute')->getData()->getId();
            $newAttribute = $attributeRepository->find($newAttributeId);

            // Si l'attribut sélectionné est de type COLOR, définir color sur null
            if ($newAttribute && $newAttribute->getType() === AttributeType::COLOR) {
                $attributeValue->setColor(null);
            }

            // Mettre à jour l'attribut de AttributeValue
            $attributeValue->setAttribute($newAttribute);

            $entityManager->flush();

            return $this->redirectToRoute('app_attribute_value_index', ['id_attribute'=>$attribute->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('attribute_value/edit.html.twig', [
            'attribute_value' => $attributeValue,
            'form' => $form,
            'colorType' => $colorType,
            'attributeTypes' => json_encode($attributeTypes),
            'attribute' => $attribute,
        ]);
    }


    #[Route('/{id}/{id_attribute}', name: 'app_attribute_value_delete', methods: ['POST'])]
    public function delete(Request $request, AttributeValue $attributeValue, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$attributeValue->getId(), $request->request->get('_token'))) {
            $entityManager->remove($attributeValue);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_attribute_value_index', ['id_attribute'=>$request->attributes->get('id_attribute')], Response::HTTP_SEE_OTHER);
    }
}
