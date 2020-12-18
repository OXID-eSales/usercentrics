<?php

namespace OxidProfessionalServices\Usercentrics\Service\Integration;

use OxidProfessionalServices\Usercentrics\Exception\PatternNotFound;
use OxidProfessionalServices\Usercentrics\Service\Integration\Pattern;
use OxidProfessionalServices\Usercentrics\Service\Integration\Pattern\IntegrationPatternInterface;

class IntegrationVersionFactory implements IntegrationVersionFactoryInterface
{
    private $versionMap = [
        Pattern\CmpV1::VERSION_NAME => Pattern\CmpV1::class,
        Pattern\CmpV2::VERSION_NAME => Pattern\CmpV2::class,
        Pattern\CmpV2Legacy::VERSION_NAME => Pattern\CmpV2Legacy::class,
        Pattern\CmpV2Tcf::VERSION_NAME => Pattern\CmpV2Tcf::class,
        Pattern\CmpV2TcfLegacy::VERSION_NAME => Pattern\CmpV2TcfLegacy::class,
        Pattern\Custom::VERSION_NAME => Pattern\Custom::class
    ];

    public function getPatternByVersion(string $integrationVersion): IntegrationPatternInterface
    {
        if (!isset($this->versionMap[$integrationVersion])) {
            throw new PatternNotFound();
        }

        /** @var IntegrationPatternInterface $integrationVersionPattern */
        $integrationVersionPattern = new $this->versionMap[$integrationVersion]();
        return $integrationVersionPattern;
    }
}
