<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            $this->addFlash('bg-danger', 'Déjà connecté !');
            return $this->redirectToRoute('admin');
        }
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }
    #[Route(path: '/connexion/api/csrf-token', name: 'api_csrf_cnx_token', methods: ["GET"])]
    public function getCsrfToken(CsrfTokenManagerInterface $csrfTokenManager): JsonResponse
    {
        $token = $csrfTokenManager->getToken('authenticate')->getValue();
        return $this->json(['token' => $token]);
    }
    #[Route(path: '/connexion2', name: 'app_connexionn', methods: ['POST',"GET"])]
    public function loginFront2(Request $request, CsrfTokenManagerInterface $csrfTokenManager, AuthenticationUtils $authenticationUtils, UserPasswordHasherInterface $passwordHasher, UserRepository $userRepository): JsonResponse
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
        $user = $userRepository->findOneBy(['email' => $username]);

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
}
