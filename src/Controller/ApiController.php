<?php

namespace App\Controller;

use ErrorException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Factory\ItemFactory;
use App\Factory\SupplierFactory;
use App\Repository\ItemRepository;
use App\Repository\SupplierRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


#[Route('/api')]
class ApiController
{
    #[Route('/inventory', name: 'api_inventory_index', methods: ['GET'])]
    public function listInventory(ItemRepository $repo): JsonResponse
    {
        $items = $repo->fetchAll();
        
        return new JsonResponse($items, Response::HTTP_OK);
    }

    #[Route('/suppliers', name: 'api_supplier_index', methods: ['GET'])]
    public function listSupplier(SupplierRepository $sRepo, ItemRepository $iRepo): JsonResponse
    {
        $suppliers = $sRepo->fetchAll();

        $items = $iRepo->fetchAll();

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
                        
                        array_push($supplier['items'], $item);
                    }
                    else
                    {
                        array_push($supplier['items'], $item);
                    }
                    
                }
            }
            array_push($supplier_info, $supplier);
        }

        return new JsonResponse($supplier_info, Response::HTTP_OK);
    }

    #[Route('/suppliers/{supplier_id}', name: 'api_find_supplier', methods: ['GET'])]
    public function findSupplier(int $supplier_id, SupplierRepository $sRepo, ItemRepository $iRepo): JsonResponse
    {

        $supplier = $sRepo->find($supplier_id);

        if(!$supplier)
        {
            $data = ['error' => 'supplier not found'];
            return new JsonResponse($data, Response::HTTP_NOT_FOUND);
        }

        $items = $iRepo->fetchAll();

        $itemList = [];

        foreach($items as $item)
        {
            if($supplier->getName() == $item['supplier'])
            {
                array_push($itemList, $item);
            }
        }

        return new JsonResponse([
            'id' => $supplier->getId(),
            'name' => $supplier->getName(),
            'address' => $supplier->getAddress(),
            'phone' => $supplier->getPhone(),
            'email' => $supplier->getEmail(),
            'website' => $supplier->getWebsite(),
            'country' => $supplier->getCountry(),
            'items' => $itemList
        ]);

    }

    #[Route('/suppliers', name: 'api_supplier_create', methods: ['POST'])]
    public function createSupplier(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if(!isset($data['name']))
        {
            return new JsonResponse(['message' => 'Request body must contain a supplier name'], Response::HTTP_BAD_REQUEST);
        }

        $supplier = SupplierFactory::new()->create($data);

        return new JsonResponse([
            'message' => 'Product created successfully',
            'id' => $supplier->getId(),
            'name' => $supplier->getName(),
            'address' => $supplier->getAddress(),
            'phone' => $supplier->getPhone(),
            'email' => $supplier->getEmail(),
            'website' => $supplier->getWebsite(),
            'country' => $supplier->getCountry(),
        ], Response::HTTP_CREATED);
    }

    #[Route('/suppliers/{supplier_id}', name: 'api_supplier_delete', methods: ['DELETE'])]
    public function deleteSupplier(int $supplier_id, SupplierRepository $sRepo, EntityManagerInterface $em): JsonResponse
    {

        $supplier = $sRepo->find($supplier_id);

        if(!$supplier)
        {
            $data = ['error' => 'supplier not found'];
            return new JsonResponse($data, Response::HTTP_NOT_FOUND);
        }

        $em->remove($supplier);
        $em->flush();

        return new JsonResponse(
            ['message' => 'Supplier deleted successfully'],
            Response::HTTP_OK
        );
    }

}
