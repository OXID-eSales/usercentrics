<?php

namespace OxidProfessionalServices\Usercentrics\Service\Integration;

use OxidProfessionalServices\Usercentrics\Exception\PatternNotFound;
use OxidProfessionalServices\Usercentrics\Service\Integration\Pattern\IntegrationPatternInterface;

class IntegrationVersionFactory implements IntegrationVersionFactoryInterface
{
    private const VERSION_MAP = [
        Pattern\CmpV1::VERSION_NAME => Pattern\CmpV1::class,
        Pattern\CmpV2::VERSION_NAME => Pattern\CmpV2::class,
        Pattern\CmpV2Legacy::VERSION_NAME => Pattern\CmpV2Legacy::class,
        Pattern\CmpV2Tcf::VERSION_NAME => Pattern\CmpV2Tcf::class,
        Pattern\CmpV2TcfLegacy::VERSION_NAME => Pattern\CmpV2TcfLegacy::class,
        Pattern\Custom::VERSION_NAME => Pattern\Custom::class
    ];

    /**
     * @throws PatternNotFound
     */
    public function getPatternByVersion(string $integrationVersion): IntegrationPatternInterface
    {
        if (!isset(self::VERSION_MAP[$integrationVersion])) {
            throw new PatternNotFound();
        }

        return new (self::VERSION_MAP[$integrationVersion]);
    }
}
