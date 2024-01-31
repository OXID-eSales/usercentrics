<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidProfessionalServices\Usercentrics\DataObject;

/** @psalm-immutable */
final class Service
{
    /**
     * @SuppressWarnings(PHPMD.ShortVariable)
     */
    public function __construct(private readonly string $name, private readonly string $id)
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getId(): string
    {
        return $this->id;
    }
}
