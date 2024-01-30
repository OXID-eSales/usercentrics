<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidProfessionalServices\Usercentrics\DataObject;

/** @psalm-immutable */
final class Script
{
    public function __construct(private readonly string $path, private readonly string $serviceId)
    {
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getServiceId(): string
    {
        return $this->serviceId;
    }
}
