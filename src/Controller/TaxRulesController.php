<?php

namespace App\Controller;

use App\Entity\TaxRules;
use App\Form\TaxRulesType;
use App\Repository\TaxRulesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/tax/rules')]
class TaxRulesController extends AbstractController
{
    #[Route('/', name: 'app_tax_rules_index', methods: ['GET'])]
    public function index(TaxRulesRepository $taxRulesRepository): Response
    {
        return $this->render('tax_rules/index.html.twig', [
            'tax_rules' => $taxRulesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_tax_rules_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $taxRule = new TaxRules();
        $form = $this->createForm(TaxRulesType::class, $taxRule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($taxRule);
            $entityManager->flush();

            return $this->redirectToRoute('app_tax_rules_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tax_rules/new.html.twig', [
            'tax_rule' => $taxRule,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tax_rules_show', methods: ['GET'])]
    public function show(TaxRules $taxRule): Response
    {
        return $this->render('tax_rules/show.html.twig', [
            'tax_rule' => $taxRule,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_tax_rules_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TaxRules $taxRule, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TaxRulesType::class, $taxRule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_tax_rules_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tax_rules/edit.html.twig', [
            'tax_rule' => $taxRule,
            'form' => $form,
        ]);
    }

    #[Route('/toggle/{id}', name: 'toggle_tax', methods: ['POST'])]
    public function toggleTaxState(int $id, Request $request, EntityManagerInterface $em): JsonResponse
    {
        $taxRule = $em->getRepository(TaxRules::class)->find($id);

        if (!$taxRule) {
            return new JsonResponse(['success' => false, 'error' => 'Tax rule not found'], 404);
        }

        $data = json_decode($request->getContent(), true);
        $taxRule->setState($data['state']);
        $em->flush();

        return new JsonResponse(['success' => true]);
    }

    #[Route('/{id}', name: 'app_tax_rules_delete', methods: ['POST'])]
    public function delete(Request $request, TaxRules $taxRule, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$taxRule->getId(), $request->request->get('_token'))) {
            $entityManager->remove($taxRule);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_tax_rules_index', [], Response::HTTP_SEE_OTHER);
    }
}
