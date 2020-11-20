<?php

declare(strict_types=1);

namespace OxidProfessionalServices\Usercentrics\Service;

use OxidProfessionalServices\Usercentrics\DataObject\Script;
use OxidProfessionalServices\Usercentrics\DataObject\Service;

interface ScriptServiceMapperInterface
{
    /**
     * Get path/url related service
     */
    public function getServiceByScriptPath(string $pathOrUrl): ?Service;

    /**
     * Get script snippet related service
     */
    public function getServiceBySnippet(string $snippetId): ?Service;

    /**
     * calculate script snippet id
     */
    public function getIdForSnippet(string $snippet): string;
}
