<?php

namespace OxidProfessionalServices\Usercentrics\Service\Integration;

class IntegrationScriptBuilder implements IntegrationScriptBuilderInterface
{
    /** @var IntegrationVersionFactory */
    private $integrationVersionFactory;

    public function __construct(
        IntegrationVersionFactory $integrationVersionFactory
    ) {
        $this->integrationVersionFactory = $integrationVersionFactory;
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
