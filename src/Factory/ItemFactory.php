<?php

namespace App\Factory;

use App\Entity\Item;
use Override;
use Zenstruck\Foundry\Persistence\PersistentObjectFactory;

/**
 * @extends PersistentObjectFactory<Item>
 */
final class ItemFactory extends PersistentObjectFactory
{

    #[Override]
    public static function class(): string
    {
        return Item::class;
    }

    #[Override]
    protected function defaults(): array|callable
    {
        $supplierCount = SupplierFactory::count();
        if ($supplierCount < 5) {
            $supplier = SupplierFactory::new();
        } else {
            $supplier = SupplierFactory::random();
        }
        return [
            'description' => self::faker()->paragraph(),
            'heightInCm' => self::faker()->numberBetween(1, 200),
            'lengthInCm' => self::faker()->numberBetween(1, 200),
            'sku' => self::faker()->text(20),
            'weightInKg' => self::faker()->numberBetween(1, 100),
            'widthInCm' => self::faker()->numberBetween(1, 200),
            'cost' => self::faker()->numberBetween(1, 100),
            'supplier' => $supplier,
        ];
    }
}
