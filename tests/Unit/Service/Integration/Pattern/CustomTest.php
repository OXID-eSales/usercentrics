<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidProfessionalServices\Usercentrics\Tests\Unit\Service\Integration\Pattern;

use OxidProfessionalServices\Usercentrics\Service\Integration\Pattern\Custom;
use OxidProfessionalServices\Usercentrics\Tests\Unit\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(\OxidProfessionalServices\Usercentrics\Service\Integration\Pattern\Custom::class)]
class CustomTest extends UnitTestCase
{
    public function testGetIntegrationScriptPattern(): void
    {
        $version = new Custom();
        $scriptPattern = $version->getIntegrationScriptPattern();
        $this->assertSame('', $scriptPattern);
    }
}
