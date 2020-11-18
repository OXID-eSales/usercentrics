<?php

declare(strict_types=1);

namespace OxidProfessionalServices\Usercentrics\Service;

use OxidProfessionalServices\Usercentrics\DataObject\Script;
use OxidProfessionalServices\Usercentrics\DataObject\Service;

interface ScriptServiceMapperInterface
{
    /**
     * Check path/url should be processed by the module
     */
    public function checkPathShouldBeProcessed(string $pathOrUrl): bool;

    /**
     * Get path/url related service
     */
    public function getScriptPathService(string $pathOrUrl): ?Service;

    /**
     * Check snipped should be processed by the module
     */
    public function checkSnippetShouldBeProcessed(string $snippet): bool;
}
