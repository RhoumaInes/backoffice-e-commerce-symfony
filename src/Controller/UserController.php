<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ProfileType;
use App\Form\UserType;
use Doctrine\ORM\EntityManager;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/user')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_user')]
    public function index(PaginatorInterface $paginator, UserRepository $userRep,Request $request): Response
    {
        $searchTerm = $request->request->get('searchuser');
        //dd($searchTerm);
        if ($searchTerm) {
            $users = $userRep->findByLikeEmail($searchTerm);
        } else {
            $users = $userRep->findAll();
        }
        $pagination = $paginator->paginate(
            $users,
            $request->query->getInt('page', 1), 
            10
        );
        
        return $this->render('user/index.html.twig', compact('pagination'));
    }

    #[Route('/{id}/edit', name: 'user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request,UserRepository $userRep, User $user, EntityManagerInterface $em): Response
    {
        
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('app_user');
        }
        //dd($form->createView());

        return $this->render('user/edit.html.twig', [
            'formedit' => $form->createView(),
        ]);
    }

    #[Route('/delete/{id}', name: 'user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_user', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/mon-profile', name: 'user_profile', methods: ['GET', 'POST'])]
    public function profile(Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(ProfileType::class, $this->getUser(), [
            'attr' => ['class' => 'form-horizontal'],
        ]);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($this->getUser());
            $em->flush();

            return $this->redirectToRoute('app_user');
        }
        //dd($form->createView());

        return $this->render('user/profile.html.twig', [
            'formprofile' => $form->createView(),
        ]);

    }
}
