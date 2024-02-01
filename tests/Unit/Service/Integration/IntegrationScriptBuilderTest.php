<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidProfessionalServices\Usercentrics\Tests\Unit\Service\Integration;

use OxidProfessionalServices\Usercentrics\Service\Integration\IntegrationScriptBuilder;
use OxidProfessionalServices\Usercentrics\Service\Integration\IntegrationVersionFactory;
use OxidProfessionalServices\Usercentrics\Service\Integration\Pattern;
use OxidProfessionalServices\Usercentrics\Tests\Unit\UnitTestCase;

/**
 * @covers \OxidProfessionalServices\Usercentrics\Service\Integration\IntegrationScriptBuilder
 */
class IntegrationScriptBuilderTest extends UnitTestCase
{
    private const PARAMS = ['{USERCENTRICS_CLIENT_ID}' => 'ABC123'];

    /**
     * @dataProvider dataProviderTestOutputPerMode
     */
    public function testGetIntegrationScript(string $versionName, string $expected): void
    {
        $builder = new IntegrationScriptBuilder(
            new IntegrationVersionFactory()
        );

        $result = $builder->getIntegrationScript($versionName, self::PARAMS);
        $this->assertHtmlEquals($expected, $result);
    }

    public static function dataProviderTestOutputPerMode(): array
    {
        return [
            [
                Pattern\CmpV2Tcf::VERSION_NAME,
                '<script id="usercentrics-cmp"
                    data-settings-id="ABC123"
                    src="https://app.usercentrics.eu/browser-ui/latest/bundle.js"
                    data-tcf-enabled
                    defer></script>'
            ],
            [
                Pattern\CmpV2TcfLegacy::VERSION_NAME,
                '<script id="usercentrics-cmp"
                    data-settings-id="ABC123"
                    src="https://app.usercentrics.eu/browser-ui/latest/bundle_legacy.js"
                    data-tcf-enabled
                    defer></script>'
            ],
            [
                Pattern\CmpV2Legacy::VERSION_NAME,
                '<script id="usercentrics-cmp"
                    data-settings-id="ABC123"
                    src="https://app.usercentrics.eu/browser-ui/latest/bundle_legacy.js"
                    defer></script>'
            ],
            [
                Pattern\CmpV2::VERSION_NAME,
                '<script id="usercentrics-cmp"
                    data-settings-id="ABC123"
                    src="https://app.usercentrics.eu/browser-ui/latest/bundle.js"
                    defer></script>'
            ],
            [
                Pattern\CmpV1::VERSION_NAME,
                '<script type="application/javascript" 
                    src="https://app.usercentrics.eu/latest/main.js" 
                    id="ABC123" ></script>'
            ]
        ];
    }

    public function testNoUsercentricsScriptInCustomMode(): void
    {
        $builder = new IntegrationScriptBuilder(
            new IntegrationVersionFactory()
        );

        $versionName = Pattern\Custom::VERSION_NAME;
        $result = $builder->getIntegrationScript($versionName, self::PARAMS);

        $this->assertEmpty($result);
    }
}
