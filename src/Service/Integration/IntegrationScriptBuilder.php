<?php

namespace OxidProfessionalServices\Usercentrics\Service\Integration;

class IntegrationScriptBuilder implements IntegrationScriptBuilderInterface
{
    public function __construct(private readonly IntegrationVersionFactoryInterface $versionFactory)
    {
    }

    public function getIntegrationScript(string $integrationVersion, array $params): string
    {
        $patternConfig = $this->versionFactory->getPatternByVersion($integrationVersion);
        return $this->replacePatternParameters($patternConfig->getIntegrationScriptPattern(), $params);
    }

    /**
     * @param array<string, string> $params
     */
    private function replacePatternParameters(string $pattern, array $params): string
    {
        return strtr($pattern, $params);
    }
}
