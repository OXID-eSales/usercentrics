<?php

namespace OxidProfessionalServices\Usercentrics\Service\Integration;

interface IntegrationScriptBuilderInterface
{
    public function getIntegrationScript(string $integrationVersion, array $params): string;
}
