<?php

namespace OxidProfessionalServices\Usercentrics\Service\Integration;

interface IntegrationScriptBuilderInterface
{
    /**
     * @param array<string, string> $params
     */
    public function getIntegrationScript(string $integrationVersion, array $params): string;
}
