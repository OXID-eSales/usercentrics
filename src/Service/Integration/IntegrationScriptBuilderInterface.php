<?php

namespace OxidProfessionalServices\Usercentrics\Service\Integration;

use OxidProfessionalServices\Usercentrics\Service\Integration\Pattern\IntegrationPatternInterface;

interface IntegrationScriptBuilderInterface
{
    public function getIntegrationScript(string $integrationVersion, array $params): string;
}
