<?php

namespace OxidProfessionalServices\Usercentrics\Service\Integration;

use OxidProfessionalServices\Usercentrics\Service\Integration\Pattern\IntegrationPatternInterface;

interface IntegrationVersionFactoryInterface
{
    public function getPatternByVersion(string $integrationVersion): IntegrationPatternInterface;
}
