<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidProfessionalServices\Usercentrics\Tests\Unit\Service\Integration\Pattern;

use OxidProfessionalServices\Usercentrics\Service\Integration\Pattern\CmpV1;
use OxidProfessionalServices\Usercentrics\Tests\Unit\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(\OxidProfessionalServices\Usercentrics\Service\Integration\Pattern\CmpV1::class)]
class CmpV1Test extends UnitTestCase
{
    public function testGetIntegrationScriptPattern(): void
    {
        $version = new CmpV1();
        $scriptPattern = $version->getIntegrationScriptPattern();
        $this->assertHtmlEquals(
            '<script type="application/javascript" 
            src="https://app.usercentrics.eu/latest/main.js" 
            id="{USERCENTRICS_CLIENT_ID}"></script>',
            $scriptPattern
        );
    }
}
