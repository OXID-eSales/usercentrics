<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidProfessionalServices\Usercentrics\Tests\Unit\Service\Integration;

use OxidProfessionalServices\Usercentrics\Service\Integration;
use OxidProfessionalServices\Usercentrics\Tests\Unit\UnitTestCase;

/**
 * @covers \OxidProfessionalServices\Usercentrics\Service\Integration\IntegrationScriptBuilder
 */
class IntegrationScriptBuilderTest extends UnitTestCase
{
    public function testGetIntegrationScript(): void
    {
        $builder = new Integration\IntegrationScriptBuilder(
            new Integration\IntegrationVersionFactory()
        );

        $versionName = Integration\Pattern\CmpV1::VERSION_NAME;
        $params = [
            '{USERCENTRICS_CLIENT_ID}' => 'ABC123'
        ];

        $result = $builder->getIntegrationScript($versionName, $params);

        $this->assertHtmlEquals(
            '<script type="application/javascript" 
                src="https://app.usercentrics.eu/latest/main.js" 
                id="ABC123" ></script>',
            $result
        );
    }
}
