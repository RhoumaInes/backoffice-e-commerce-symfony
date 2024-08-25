<?php

namespace App\Controller;

use App\Entity\Client;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class ClientAuthController extends AbstractController
{
    #[Route('/client/auth', name: 'app_client_auth')]
    public function index(): Response
    {
        return $this->render('client_auth/index.html.twig', [
            'controller_name' => 'ClientAuthController',
        ]);
    }

    #[Route('/api/csrf-token', name: 'api_csrf_token', methods: ['GET'])]
    public function getToken(CsrfTokenManagerInterface $csrfTokenManager): JsonResponse
    {
        $token = $csrfTokenManager->getToken('register')->getValue();

        return new JsonResponse(['token' => $token]);
    }
    
    #[Route('/register', name: 'app_register_from_register', methods: ['POST'])]
    public function registerFromFront(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager, CsrfTokenManagerInterface $csrfTokenManager): Response
    {
        $csrfToken = $request->request->get('_csrf_token');
        if (!$csrfTokenManager->isTokenValid(new CsrfToken('register', $csrfToken))) {
            return new Response('Invalid CSRF token', Response::HTTP_FORBIDDEN);
        }
        $lastname = $request->request->get('lastname');
        $firstname = $request->request->get('firstname');
        $password = $request->request->get('password');
        $email = $request->request->get('email');

        if (!$lastname || !$firstname || !$password || !$email) {
            return new Response('Invalid data', Response::HTTP_BAD_REQUEST);
        }

        $user = new Client();
        $user->setLastname($lastname);
        $user->setFirstname($firstname);
        $user->setEmail($email);
        $user->setPassword($passwordHasher->hashPassword($user, $password));

        $entityManager->persist($user);
        $entityManager->flush();

        return new Response('User registered successfully', Response::HTTP_OK);
    }
    #[Route(path: '/connexion/api/csrf-token', name: 'api_csrf_cnx_token', methods: ["GET"])]
    public function getCsrfToken(CsrfTokenManagerInterface $csrfTokenManager): JsonResponse
    {
        $token = $csrfTokenManager->getToken('authenticate')->getValue();
        return $this->json(['token' => $token]);
    }
    #[Route(path: '/connexion2', name: 'app_connexionn', methods: ['POST',"GET"])]
    public function loginFront2(Request $request, CsrfTokenManagerInterface $csrfTokenManager, AuthenticationUtils $authenticationUtils, UserPasswordHasherInterface $passwordHasher, ClientRepository $clientRepository): JsonResponse
    {
        // Get the CSRF token from the request
        $submittedToken = $request->request->get('_csrf_token');

        // Validate the CSRF token
        if (!$this->isCsrfTokenValid('authenticate', $submittedToken)) {
            return $this->json(['success' => false, 'message' => 'Invalid CSRF token'], 400);
        }
        // Retrieve credentials from the request
        $username = $request->request->get('username');
        $password = $request->request->get('password');

        // Validate credentials (implement your authentication logic here)
        $user = $clientRepository->findOneBy(['email' => $username]);

        if (!$user || !$passwordHasher->isPasswordValid($user, $password)) {
            // Invalid credentials
            return new JsonResponse([
                'success' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }

        // Return JSON response with login data including CSRF token
        return new JsonResponse([
            'success' => true,
            'username' => $username,
            // Add any other relevant data you need to return
        ]);
    }
    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    #[Route('/avatar/api/check-avatar', name: 'check_avatar', methods: ['GET'])]
    public function checkUserAvatar(Request $request, ClientRepository $clientRepository): JsonResponse
    {
        $username = $request->query->get('username');

        if (empty($username)) {
            return new JsonResponse(['success' => false, 'message' => 'Username not provided.'], JsonResponse::HTTP_BAD_REQUEST);
        }

        // Retrieve the user by username
        $user = $clientRepository->findOneBy(['email' => $username]);

        if (!$user) {
            return new JsonResponse(['success' => false, 'message' => 'User not found.'], JsonResponse::HTTP_NOT_FOUND);
        }

        if ($user->getAvatarUrl()) {
            return new JsonResponse([
                'success' => true,
                'has_avatar' => true,
                'avatar_url' => $user->getAvatarUrl(),
            ]);
        } else {
            return new JsonResponse([
                'success' => true,
                'has_avatar' => false,
            ]);
        }
    }

    #[Route('/avatar/api/save-avatar', name: 'save_avatar', methods: ['POST'])]
    public function saveAvatar(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $username = $request->request->get('username');
        $avatarUrl = $request->request->get('avatar_url');
        //return new JsonResponse(['avatar_url' => $request->request], 400);
        if (!$username || !$avatarUrl) {
            return new JsonResponse(['error' => 'Username and avatar URL are required'], 400);
        }

        $clientRepository = $em->getRepository(Client::class);
        $user = $clientRepository->findOneBy(['email' => $username]);

        if (!$user) {
            return new JsonResponse(['error' => 'User not found'], 404);
        }
        $user->setAvatarUrl($avatarUrl);
        //return new JsonResponse(['avatarUrl' => $avatarUrl], 404);
        $em->flush();
        return new JsonResponse(['message' => 'Avatar saved successfully'], 200);
    }
}
