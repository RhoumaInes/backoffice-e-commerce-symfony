<?php
namespace App\Controller;

use App\Entity\Client;
use App\Repository\ClientRepository;
use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

#[Route('/admin/clients')]
class ClientController extends AbstractController
{
    #[Route('/', name: 'admin_clients_list', methods: ['GET','POST'])]
    public function list(PaginatorInterface $paginator,ClientRepository $clientRepository,Request $request): Response
    {
        $searchTerm = $request->request->get('searchclient');
        if ($searchTerm) {
            $clients = $clientRepository->findByLikeEmail($searchTerm);
        } else {
            $clients = $clientRepository->findAll();
        }
        $pagination = $paginator->paginate(
            target: $clients,
            page: $request->query->getInt('page', 1), 
            limit: 10
        );
        return $this->render(view: 'client/index.html.twig', parameters: [
            'clients' => $pagination,
        ]);
    }

    #[Route('/toggle/{id}', name: 'admin_client_toggle', methods: ['POST'])]
    public function toggleStatus(Client $client, EntityManagerInterface $em): Response
    {
        $client->setIsActive(isActive: !$client->getIsActive());
        $em->flush();

        $this->addFlash('success', 'Statut du compte client mis à jour.');
        return $this->redirectToRoute('admin_clients_list');
    }

    #[Route('/{id}/orders', name: 'admin_client_orders', methods: ['GET'])]
    public function viewOrders(Client $client, OrderRepository $orderRepository): Response
    {
        $orders = $orderRepository->findBy(['client' => $client]);
        return $this->render('client/orders.html.twig', [
            'client' => $client,
            'orders' => $orders,
        ]);
    }
}
