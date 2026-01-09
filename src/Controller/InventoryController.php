<?php

namespace App\Controller;

use App\Factory\ItemFactory;
use App\Repository\ItemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/inventory')]
final class InventoryController extends AbstractController
{
    #[Route('/', name: 'inventory_index', methods: ['GET'])]
    public function index(ItemRepository $repo): Response
    {
        $items = $repo->fetchAll();
        return $this->render('inventory/index.html.twig', [
            'items' => $items,
        ]);
    }

    #[Route('/generate_list', name: 'inventory_generate', methods: ['GET'])]
    public function generateItems(): Response
    {
        ItemFactory::createMany(5);
        return $this->redirectToRoute('inventory_index');
    }

    #[Route('/clear_list', name: 'inventory_clear', methods: ['GET'])]
    public function clearItems(ItemRepository $repo): Response
    {
        $repo->deleteAll();
        return $this->redirectToRoute('inventory_index');
    }
}
