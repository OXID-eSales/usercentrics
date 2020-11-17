<?php

declare(strict_types=1);

namespace OxidProfessionalServices\Usercentrics\Service;

use OxidProfessionalServices\Usercentrics\DataObject\Script;
use OxidProfessionalServices\Usercentrics\DataObject\Service;

interface ScriptServiceMapperInterface
{
    public function isScriptWhitelisted(string $pathOrUrl): bool;

    public function scriptService(string $pathOrUrl): ?Service;

    public function isSnippetWhitelisted(string $snippet): bool;
}
