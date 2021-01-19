<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidProfessionalServices\Usercentrics\Tests\Unit\Service\Integration;

use OxidProfessionalServices\Usercentrics\Exception\PatternNotFound;
use OxidProfessionalServices\Usercentrics\Service\Integration\IntegrationVersionFactory;
use OxidProfessionalServices\Usercentrics\Service\Integration\Pattern\CmpV1;
use OxidProfessionalServices\Usercentrics\Tests\Unit\UnitTestCase;

/**
 * @covers \OxidProfessionalServices\Usercentrics\Service\Integration\IntegrationVersionFactory
 */
class IntegrationVersionFactoryTest extends UnitTestCase
{
    public function testGetIntegrationScriptPattern(): void
    {
        $versionName = CmpV1::VERSION_NAME;
        $factory = new IntegrationVersionFactory();
        $patternObject = $factory->getPatternByVersion($versionName);

        $this->assertInstanceOf(CmpV1::class, $patternObject);
    }

    public function testGetNotExistingIntegrationScriptPattern(): void
    {
        $this->expectException(PatternNotFound::class);

        $versionName = 'NotExisting';
        $factory = new IntegrationVersionFactory();
        $patternObject = $factory->getPatternByVersion($versionName);
    }
}
