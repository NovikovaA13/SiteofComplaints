<?php

namespace App\Factory;

use App\Entity\Complaint;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<Complaint>
 */
final class ComplaintFactory extends PersistentProxyObjectFactory
{

    public static function class(): string
    {
        return Complaint::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        return [
            'author' => UserFactory::random(),
            'createdAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
            'text' => self::faker()->text(),
            'title' => self::faker()->title(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Complaint $complaint): void {})
        ;
    }
}
