<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidProfessionalServices\Usercentrics\Tests\Unit\Service\Integration\Pattern;

use OxidProfessionalServices\Usercentrics\Service\Integration\Pattern\CmpV2;
use OxidProfessionalServices\Usercentrics\Tests\Unit\UnitTestCase;

/**
 * @covers \OxidProfessionalServices\Usercentrics\Service\Integration\Pattern\CmpV2
 */
class CmpV2Test extends UnitTestCase
{
    public function testGetIntegrationScriptPattern(): void
    {
        $version = new CmpV2();
        $scriptPattern = $version->getIntegrationScriptPattern();
        $this->assertHtmlEquals(
            '<script id="usercentrics-cmp"
                data-settings-id="{USERCENTRICS_CLIENT_ID}"
                src="https://app.usercentrics.eu/browser-ui/latest/bundle.js"
                defer></script>',
            $scriptPattern
        );
    }
}
