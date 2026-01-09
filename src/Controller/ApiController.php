<?php

namespace App\Controller;

use ErrorException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api')]
class ApiController
{
    #[Route('/inventory', name: 'api_inventory_index', methods: ['GET'])]
    public function listInventory(): Response
    {
        throw new ErrorException("TODO: Implement this");
    }
}
