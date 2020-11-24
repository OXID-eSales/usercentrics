<?php

declare(strict_types=1);

namespace OxidProfessionalServices\Usercentrics\Service;

use OxidProfessionalServices\Usercentrics\DataObject\Script;
use OxidProfessionalServices\Usercentrics\DataObject\Service;

interface ScriptServiceMapperInterface
{
    /**
     * Get script path/url related service
     */
    public function getServiceByScriptPath(string $pathOrUrl): ?Service;

    /**
     * Get script snippet related service
     */
    public function getServiceBySnippetId(string $snippetId): ?Service;

    /**
     * Calculate script snippet id by snippet contents
     */
    public function calculateSnippetId(string $snippet): string;
}
