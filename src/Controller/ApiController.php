<?php

namespace App\Controller;

use ErrorException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Factory\ItemFactory;
use App\Repository\ItemRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
//use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/api')]
class ApiController
{
    // #[Route('/inventory', name: 'api_inventory_index', methods: ['GET'])]
    // public function listInventory(): Response
    // {
    //     throw new ErrorException("TODO: Implement this");
    // }
    #[Route('/inventory', name: 'api_inventory_index', methods: ['GET'])]
    public function listInventory(ItemRepository $repo): JsonResponse
    {
        $items = $repo->fetchAll();
        // return $this->json($items, Response::HTTP_OK);
        return new JsonResponse($items, Response::HTTP_OK);
    }
}
