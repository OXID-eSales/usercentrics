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
    /**
     * @var string
     */
    private $path;

    /**
     * @var string
     */
    private $serviceId;

    /**
     * Script constructor.
     * @param string $path
     * @param string $serviceId
     */
    public function __construct(string $path, string $serviceId)
    {
        $this->path = $path;
        $this->serviceId = $serviceId;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function getServiceId(): string
    {
        return $this->serviceId;
    }
}
