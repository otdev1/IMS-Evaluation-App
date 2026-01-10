<?php

namespace App\Controller;

use App\Factory\SupplierFactory;
use App\Repository\ItemRepository;
use App\Repository\SupplierRepository;
use ErrorException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/supplier')]
final class SupplierController extends AbstractController
{
    #[Route('/', name: 'supplier_index', methods: ['GET'])]
    public function index(SupplierRepository $sRepo, ItemRepository $iRepo): Response
    {
        $items = $iRepo->fetchAll();

        $suppliers = $sRepo->fetchAll();

        $supplier_info = [];

        foreach($suppliers as $supplier)
        {
            foreach($items as $item)
            {
                if($supplier['name'] == $item['supplier'])
                {
                    if(!array_key_exists('items', $supplier))
                    {
                        $supplier['items'] = [];
                        
                        array_push($supplier['items'], (object) $item);
                    }
                    else
                    {
                        array_push($supplier['items'], (object) $item);
                    }
                    
                }
            }

            array_push($supplier_info, $supplier);
        }

        return $this->render('suppliers/index.html.twig', [
            'supplier_info' => $supplier_info
        ]);
    }
}
