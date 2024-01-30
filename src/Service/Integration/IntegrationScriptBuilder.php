<?php

namespace OxidProfessionalServices\Usercentrics\Service\Integration;

class IntegrationScriptBuilder implements IntegrationScriptBuilderInterface
{
    public function __construct(private readonly IntegrationVersionFactoryInterface $integrationVersionFactory)
    {
    }

    public function getIntegrationScript(string $integrationVersion, array $params): string
    {
        $patternConfig = $this->integrationVersionFactory->getPatternByVersion($integrationVersion);
        return $this->replacePatternParameters($patternConfig->getIntegrationScriptPattern(), $params);
    }

    private function replacePatternParameters(string $pattern, array $params): string
    {
        return strtr($pattern, $params);
    }
}
