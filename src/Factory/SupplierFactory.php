<?php

namespace App\Factory;

use App\Entity\Supplier;
use Override;
use Zenstruck\Foundry\Persistence\PersistentObjectFactory;

/**
 * @extends PersistentObjectFactory<Supplier>
 */
final class SupplierFactory extends PersistentObjectFactory
{
    #[Override]
    public static function class(): string
    {
        return Supplier::class;
    }

    #[Override]
    protected function defaults(): array|callable
    {

        // $items = ItemFactory::createMany(5);

        //$items = ItemFactory::new()->many(5);

        // $itemsCount = count($items);

        // $itemsCost = 0.00;

        // foreach ($items as $item)
        // {
        //     $itemCost += $item->getCost();
        // }

        return [
            'address' => self::faker()->address(),
            'name' => self::faker()->company(),
            'phone' => self::faker()->phoneNumber(),
            'email' => self::faker()->email(),
            'website' => self::faker()->url(),
            'country' => self::faker()->country(),
            //'items' => $items,
        ];
    }
}
