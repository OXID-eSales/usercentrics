<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidProfessionalServices\Usercentrics\DataObject;

/** @psalm-immutable */
final class ScriptSnippet
{
    /**
     * @SuppressWarnings(PHPMD.ShortVariable)
     */
    public function __construct(private readonly string $id, private readonly string $serviceId)
    {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getServiceId(): string
    {
        return $this->serviceId;
    }
}
