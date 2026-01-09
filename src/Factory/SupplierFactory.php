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
        return [
            'address' => self::faker()->address(),
            'name' => self::faker()->company(),
            'phone' => self::faker()->phoneNumber(),
            'email' => self::faker()->email(),
            'website' => self::faker()->url(),
            'country' => self::faker()->country(),
        ];
    }
}
