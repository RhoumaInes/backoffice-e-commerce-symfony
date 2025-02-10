<?php

namespace App\Controller\Admin;

use App\Entity\Client;
use App\Entity\Order;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/', name: 'app_home')]
    public function redirection(): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('admin');
        }
        return $this->redirectToRoute('app_login');
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        if ($this->getUser()) {
            // Récupérer les statistiques
            $totalOrders = $this->entityManager->getRepository(Order::class)
            ->createQueryBuilder('o')
            ->select('COUNT(o.id)')
            ->where('o.cancelled = :false OR o.cancelled IS NULL')
            ->setParameter('false', false)
            ->getQuery()
            ->getSingleScalarResult();
            $paidOrders = $this->entityManager->getRepository(Order::class)->count(['paid' => true]);
            $totalUsers = $this->entityManager->getRepository(Client::class)->count([]);
            $totalEmployees = $this->entityManager->getRepository(User::class)
            ->createQueryBuilder('u')
            ->select('COUNT(u.id)')
            ->getQuery()
            ->getSingleScalarResult();

            /*->where('u.roles LIKE :role')
            ->setParameter('role', '%ROLE_USER%')*/


            // Calcul du pourcentage des commandes payées
            $paidOrdersPercentage = ($totalOrders > 0) ? round(($paidOrders / $totalOrders) * 100) : 0;

            return $this->render('dashboard.html.twig', [
                'totalOrders' => $totalOrders,
                'paidOrdersPercentage' => $paidOrdersPercentage,
                'totalUsers' => $totalUsers,
                'totalEmployees' => $totalEmployees,
            ]);
        }
        return $this->redirectToRoute('app_login');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('CourseExpress');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
