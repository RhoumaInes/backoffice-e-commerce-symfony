<?php

namespace App\Controller;

use App\Entity\Avatar;
use App\Entity\User;
use App\Form\AvatarType;
use App\Repository\AvatarRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

#[Route('/avatar')]
class AvatarController extends AbstractController
{
    #[Route('/', name: 'app_avatar_index', methods: ['GET'])]
    public function index(AvatarRepository $avatarRepository): Response
    {
        return $this->render('avatar/index.html.twig', [
            'avatars' => $avatarRepository->findAll(),
        ]);
    }


    #[Route('/new', name: 'app_avatar_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $avatar = new Avatar();
        $form = $this->createForm(AvatarType::class, $avatar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($avatar);
            $entityManager->flush();

            return $this->redirectToRoute('app_avatar_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('avatar/new.html.twig', [
            'avatar' => $avatar,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_avatar_show', methods: ['GET'])]
    public function show(Avatar $avatar): Response
    {
        return $this->render('avatar/show.html.twig', [
            'avatar' => $avatar,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_avatar_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Avatar $avatar, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AvatarType::class, $avatar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_avatar_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('avatar/edit.html.twig', [
            'avatar' => $avatar,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_avatar_delete', methods: ['POST'])]
    public function delete(Request $request, Avatar $avatar, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$avatar->getId(), $request->request->get('_token'))) {
            $entityManager->remove($avatar);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_avatar_index', [], Response::HTTP_SEE_OTHER);
    }


    #[Route('/api/avatar', methods: ['POST'])]
    public function saveAvatar(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $user = $this->getUser();

        if (!$user) {
            return new JsonResponse(['error' => 'User not authenticated'], 403);
        }

        $avatar = $em->getRepository(Avatar::class)->findOneBy(['user' => $user]) ?? new Avatar();
        $avatar->setUserId($user);
        $avatar->setAvatarUrl($data['avatarUrl']);

        $em->persist($avatar);
        $em->flush();

        return new JsonResponse(['success' => true]);
    }

    #[Route('/api/avatar', methods: ['GET'])]
    public function getAvatar(EntityManagerInterface $em): JsonResponse
    {
        $user = $this->getUser();

        if (!$user) {
            return new JsonResponse(['error' => 'User not authenticated'], 403);
        }

        $avatar = $em->getRepository(Avatar::class)->findOneBy(['user' => $user]);

        if (!$avatar) {
            return new JsonResponse(['avatarUrl' => null]);
        }

        return new JsonResponse(['avatarUrl' => $avatar->getAvatarUrl()]);
    }
}
