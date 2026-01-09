<?php

namespace App\Controller;

use App\Factory\SupplierFactory;
use App\Repository\ItemRepository;
use ErrorException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/supplier')]
final class SupplierController extends AbstractController
{
    #[Route('/', name: 'supplier_index', methods: ['GET'])]
    public function index(): Response
    {
        throw new ErrorException("TODO: Implement this");
    }

    #[Route('/generate_list', name: 'supplier_generate', methods: ['GET'])]
    public function generateItems(): Response
    {
        SupplierFactory::createMany(5);
        return $this->redirectToRoute('supplier_index');
    }

    #[Route('/clear_list', name: 'supplier_clear', methods: ['GET'])]
    public function clearItems(ItemRepository $repo): Response
    {
        $repo->deleteAll();
        return $this->redirectToRoute('supplier_index');
    }
}
