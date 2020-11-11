<?php


namespace OxidProfessionalServices\Usercentrics\Service;

use OxidProfessionalServices\Usercentrics\DataObject\Script;
use OxidProfessionalServices\Usercentrics\DataObject\Service;

interface ScriptRepository
{
    public function isScriptWhitelisted(string $pathOrUrl): bool;
    public function scriptService(string $pathOrUrl): ?Service;
    public function isSnippetWhitelisted(string $snippet): bool;
}
