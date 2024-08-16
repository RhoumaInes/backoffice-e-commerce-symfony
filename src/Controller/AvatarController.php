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

    #[Route('/api/save-avatar', name: 'save_avatar', methods: ['POST'])]
    public function saveAvatar(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $username = $request->request->get('username');
        $avatarUrl = $request->request->get('avatar_url');
        //return new JsonResponse(['avatar_url' => $request->request], 400);
        if (!$username || !$avatarUrl) {
            return new JsonResponse(['error' => 'Username and avatar URL are required'], 400);
        }

        $userRepository = $em->getRepository(User::class);
        $user = $userRepository->findOneBy(['email' => $username]);

        if (!$user) {
            return new JsonResponse(['error' => 'User not found'], 404);
        }
        $avatar = new Avatar();
        $avatar->setUserId($user);
        $avatar->setAvatarUrl($avatarUrl);
        $avatar->setCreatedAt(new \DateTimeImmutable());
        $avatar->setUpdatedAt(new \DateTimeImmutable());
        $em->persist($avatar);
        $em->flush();
        return new JsonResponse(['message' => 'Avatar saved successfully'], 200);
    }

    #[Route('/api/check-avatar', name: 'check_avatar', methods: ['GET'])]
    public function checkUserAvatar(Request $request, AvatarRepository $avatarRepository, UserRepository $userRepository): JsonResponse
    {
        $username = $request->query->get('username');

        if (empty($username)) {
            return new JsonResponse(['success' => false, 'message' => 'Username not provided.'], JsonResponse::HTTP_BAD_REQUEST);
        }

        // Retrieve the user by username
        $user = $userRepository->findOneBy(['email' => $username]);

        if (!$user) {
            return new JsonResponse(['success' => false, 'message' => 'User not found.'], JsonResponse::HTTP_NOT_FOUND);
        }

        // Check if the user has an avatar
        $avatar = $avatarRepository->findOneBy(['userId' => $user]);

        if ($avatar) {
            return new JsonResponse([
                'success' => true,
                'has_avatar' => true,
                'avatar_url' => $avatar->getAvatarUrl(),
            ]);
        } else {
            return new JsonResponse([
                'success' => true,
                'has_avatar' => false,
            ]);
        }
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
}
