<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidProfessionalServices\Usercentrics\DataObject;

/** @psalm-immutable */
final class Configuration
{
    /**
     * @param Service[] $services
     * @param Script[] $scripts
     * @param ScriptSnippet[] $scriptSnippets
     */
    public function __construct(
        private readonly array $services,
        private readonly array $scripts,
        private readonly array $scriptSnippets
    ) {
    }

    /**
     * @return Script[]
     */
    public function getScripts(): array
    {
        return $this->scripts;
    }

    /**
     * @return Service[]
     */
    public function getServices(): array
    {
        return $this->services;
    }

    /**
     * @return ScriptSnippet[]
     */
    public function getScriptSnippets(): array
    {
        return $this->scriptSnippets;
    }
}
